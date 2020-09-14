<?php
/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 8/3/17
 * Time: 5:06 PM
 */

namespace App\Repository\Documents;


use App\Models\DocumentCategory;
use App\Models\IncomingDocument;
use App\Repository\Configuration\FiscalYearRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class IncomingDocumentRepo
{
    /**
     * @var IncomingDocument
     */
    private $incomingDocument;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    public function __construct(IncomingDocument $incomingDocument, FiscalYearRepository $fiscalYearRepository)
    {
        $this->incomingDocument = $incomingDocument;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

//    public function all()
//    {
//        return $this->incomingDocument
//            ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_incoming_documents.sender_institution_id')
//            ->join('users', 'users.id', '=', 'dms_incoming_documents.uploaded_by_user_id')
//            ->join('departments', 'departments.id', '=', 'dms_incoming_documents.receiver_department_id')
//            ->select('dms_incoming_documents.*', 'dms_institutions.*', 'users.*', 'departments.*', 'dms_incoming_documents.id as id',
//                'dms_incoming_documents.created_at as created_at')
//            ->orderBy('dms_incoming_documents.id', 'Desc')
//            ->get();
//
//    }
    public static function find($id)
    {
        Self::getDepartmentWise($id);
    }

    public function findById($id)
    {
        $value = Self::getDepartmentWise($id);
        return $value;
    }

    public function getAllIncomingDocumentByInstitution($id)
    {
        $department = Auth::user()->department_id;
        if (User::isSuperAdmin()) {
            return $this->incomingDocument
                ->where('sender_institution_id', $id)
                ->orderBy('id', 'DESC');

        } else {
            $document = IncomingDocument::where('receiver_department_id', '=', $department)
                ->where('sender_institution_id', $id)
                ->select('dms_incoming_documents.*');

            $user = IncomingDocument::where('uploaded_by_user_id', Auth::user()->id)
                ->where('sender_institution_id', $id);

            $documentPrivacy = IncomingDocument::where('dms_incoming_documents.incoming_document_privacy', '=', 'General')
                ->where('sender_institution_id', $id);

            return $document->union($documentPrivacy)->union($user)
                ->where('sender_institution_id', $id);
        }

    }

    public function getIssueNumber($document_category_id, $request_received_date)
    {
       
        /*Get current year and code*/

        $year = $this->fiscalYearRepository->getFiscalYear($request_received_date);

        $yearTitle = $year->fy_name;


        /* Get Max Serial Number from issues table*/
        $res_max =
            DB::table('dms_incoming_documents')
                ->where('document_received_date', '>=', $year->fy_start_date)
                ->where('document_received_date', '<=', $year->fy_end_date)
                ->max('incoming_serial_number');

        $max_serial_number = isset($res_max) ? $res_max : 0;
//        dd($max_serial_number);
        $next_serial_number = $max_serial_number + 1;
        /* Get template code by letter id*/

        $res_code = DocumentCategory::find($document_category_id);

//        $serial = $res_code->category_name;


        $substring = substr($res_code->category_name, 0, 3);

        $category_code = strtoupper($substring);

        $regCode = $yearTitle . '-' . $category_code . '-' . $next_serial_number;

        return ['incoming_document_registration_number' => $regCode,
            'incoming_serial_number' => $next_serial_number
        ];

    }

    public function getfilter($request)
    {
        $department = Auth::user()->department_id;
        $user = Auth::user()->id;
        if (User::isSuperAdmin()) {
            $document = $this->incomingDocument;

        } else {
            $document = $this->incomingDocument;
//         
            $departmentQuery = clone $document;
            $confidentialQuery = clone $document;
            $incomingDocument1 = $departmentQuery
                ->when('dms_incoming_documents.incoming_document_privacy==Departmental', function ($q) {
                    $q->where('users.department_id', '=', Auth::user()->department_id);

                })
                ->orderBy('dms_incoming_documents.id', 'desc');


            $outgoingDocument2 = $confidentialQuery
                ->when('dms_incoming_documents.incoming_document_privacy==Departmental', function ($q) {


                    $q->whereIn('dms_incoming_documents.id', function ($q) {
                        return $q->select('dms_document_privacy.document_id')
                            ->from('dms_document_privacy')
                            ->where('dms_document_privacy.document_type', '=', 'incoming')
                            ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
                    });

                })->orderBy('dms_incoming_documents.id', 'desc');


            if ($outgoingDocument2->count() != 0) {
//                $outgoingDocument=$outgoingDocument2->get()->merge($incomingDocument1->get());
                $incomingDocument = $incomingDocument1->union($outgoingDocument2);


            } else {
                $incomingDocument = $incomingDocument1;
            }


        }


        if ($request->has('search_field') && $request->search_field!=null) {
            $searchData = $request->get('search_field');
            $document = $document
                ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_incoming_documents.sender_institution_id')
                ->join('dms_document_categories', 'dms_document_categories.id', '=', 'dms_incoming_documents.document_category_id')
                ->join('dms_document_tags', 'dms_document_tags.document_id', '=', 'dms_incoming_documents.id')
                ->join('dms_tags', 'dms_tags.id', '=', 'dms_document_tags.tag_id')
                ->join('users', 'users.id', '=', 'dms_incoming_documents.uploaded_by_user_id')
                ->join('departments', 'departments.id', '=', 'receiver_department_id')
                ->orWhere('dms_incoming_documents.incoming_document_subject', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_document_categories.category_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('departments.department_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_institutions.institution_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('users.name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_tags.tag_name', 'LIKE', '%' . strtolower($searchData) . '%');
        }
        if ($request->has('folder_id') && $request->folder_id!=null) {
            $value = $request->folder_id;
            $document = $document->where('dms_incoming_documents.folder_id', '=', $value );
        }
        if ($request->has('incoming_document_subject')) {
            $value = $request->incoming_document_subject;
            $document = $document->where('dms_incoming_documents.incoming_document_subject', 'LIKE', '%' . $value . '%');
        }
        if ($request->has('document_category_id')) {

            $document = $document->where('dms_incoming_documents.document_category_id', $request->get('document_category_id'));
        }
        if ($request->has('receiver_department_id')) {

            $document = $document->where('dms_incoming_documents.receiver_department_id', $request->get('receiver_department_id'));
        }
        if ($request->has('sender_institution_id')) {

            $document = $document->where('dms_incoming_documents.sender_institution_id', $request->get('sender_institution_id'));
        }
        if ($request->has('incoming_document_date_from') && $request->get('incoming_document_date_from') != '' && $request->get('incoming_document_date_to') == '') {

            $document->where('dms_incoming_documents.document_received_date', '>=', $request->incoming_document_date_from);
        }
        if ($request->has('incoming_document_date_to') && $request->get('incoming_document_date_to') != '' && $request->get('incoming_document_date_from') == '') {
            $document->where('dms_incoming_documents.document_received_date', '<=', $request->get('incoming_document_date_to'));
        }
        if ($request->has('incoming_document_date_from') && $request->get('incoming_document_date_from') != '' && $request->has('incoming_document_date_to') && $request->get('incoming_document_date_to') != '') {
            if ($request->get('incoming_document_date_from') > $request->get('incoming_document_date_to')) {

                $document->whereBetween('dms_incoming_documents.incoming_document_date', array($request->get('incoming_document_date_to'), $request->get('incoming_document_date_from')));


            } else
                $document->whereBetween('dms_incoming_documents.incoming_document_date', array(date($request->get('incoming_document_date_from')), date($request->get('incoming_document_date_to'))));


        }

        return $document->orderBy('dms_incoming_documents.id', 'desc');
    }

    public function getDepartmentWise($id)
    {
        $user = Auth::user()->id;
        $department = Auth::user()->department_id;
        if (User::isSuperAdmin()) {
            return $this->incomingDocument
                ->find($id);

        } else {
            $document = $this->incomingDocument
                ->where(function ($q) use ($user, $department) {
                    $q->where('uploaded_by_user_id', $user)
                        ->orwhere('receiver_department_id', $department)
                        ->orwhere(function ($q) {
                            $q->orWhere('incoming_document_privacy', 'General');
                        })
                        ->orwhere(function ($query) {
                            $query->whereIn('dms_incoming_documents.id', function ($q) {
                                $q->select('document_id')
                                    ->from('dms_document_privacy')
                                    ->where('dms_document_privacy.document_type', '=', 'incoming')
                                    ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
                            });
                        });
                });

            return $document->where('dms_incoming_documents.id', $id)->first();
//            $document = IncomingDocument::where('receiver_department_id', '=', $department)
//                ->where('id', '=', $id);
//
//            $user = IncomingDocument::where('uploaded_by_user_id', Auth::user()->id)
//                ->where('id', '=', $id);
//
//            $documentPrivacy = IncomingDocument::where('dms_incoming_documents.incoming_document_privacy', '=', 'General')
//                ->where('id', '=', $id);
//
//            return $document->union($documentPrivacy)->union($user)
//                ->where('dms_incoming_documents.id', '=', $id)
//                ->first();

        }
    }

    public function getDocumentByMonth($month)
    {

        $letter = $this->incomingDocument;

        if (User::isSuperAdmin()) {
            $letters = $letter->where(DB::raw('YEAR(dms_incoming_documents.created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(dms_incoming_documents.created_at)'), '=', date('m', $month))
                ->select('dms_incoming_documents.created_at')
                ->get();
        } else {
            $letters = $this->incomingDocument
                ->join('users', 'users.id', '=', 'dms_incoming_documents.uploaded_by_user_id')
                ->where(function ($q) {
//
                    $q->where('dms_incoming_documents.uploaded_by_user_id', '=', Auth::user()->id)
                        ->orwhere(function ($q) {
                            $q->where('dms_incoming_documents.incoming_document_privacy', '=', 'General');
                        })
                        ->orwhere('users.department_id', '=', Auth::user()->department_id)
                        ->orwhere(function ($q) {
                            $q->whereIn('dms_incoming_documents.id', function ($query) {
                                $query->select('document_id')
                                    ->from('dms_document_privacy')
                                    ->where('dms_document_privacy.document_type', '=', 'incoming')
                                    ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
                            });

                        });

                })->where(DB::raw('YEAR(dms_incoming_documents.created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(dms_incoming_documents.created_at)'), '=', date('m', $month))
                ->select('dms_incoming_documents.created_at')
                ->get();
        }

        return count($letters);

    }

}