<?php
/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 8/2/17
 * Time: 1:00 PM
 */

namespace App\Repository\Documents;

use App\Models\OutgoingDocument;
use App\Models\Template;
use App\Repository\Configuration\FiscalYearRepository;
use App\User;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Stmt\Case_;

class OutgoingDocumentRepository
{

    /**
     * @var OutgoingDocument
     */
    private $outgoingDocument;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    public function __construct(OutgoingDocument $outgoingDocument, FiscalYearRepository $fiscalYearRepository)
    {
        $this->outgoingDocument = $outgoingDocument;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    public function all($request)
    {


        $outgoingDocument = $this->outgoingDocument
            ->join('dms_templates', 'dms_templates.id', '=', 'dms_outgoing_documents.template_id')
            ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_outgoing_documents.institution_id')
            ->join('users', 'users.id', '=', 'dms_outgoing_documents.created_by_user_id')
            ->select('dms_outgoing_documents.*', 'dms_templates.*', 'dms_institutions.*', 'users.*',
                'dms_outgoing_documents.created_at as created_at', 'dms_institutions.id as institution_id', 'dms_outgoing_documents.id as id');
//            ->whereIn('dms_outgoing_documents.id', function ($query) {
//                $query->select('dms_document_privacy.document_id')
//                    ->from('dms_document_privacy')
//                    ->where('dms_document_privacy.document_type', '=', 'outgoing')
//                    ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
//            });
        if (User::isSuperAdmin()) {

            $outgoingDocument
                ->orderBy('dms_outgoing_documents.id', 'desc');
        } else {
            /*
              SELECT * FROM `dms_outgoing_documents` WHERE
            ((created_by_user_id=3 OR signature_user_id=3 OR issued_by=3)
            OR
            outgoing_document_privacy = 'General')
              OR
            (created_by_user_id IN(select id FROM users where department_id=1))
            OR
            id IN(SELECT document_id FROM dms_document_privacy where document_type = 'Outgoing'
              AND
            user_id=3) ORDER by id desc*/

//
//            $outgoingDocument = $outgoingDocument
//                ->where(function ($q) {
////
//                    $q->where('dms_outgoing_documents.created_by_user_id', '=', Auth::user()->id)
//                        ->orwhere('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id)
//                        ->orwhere('dms_outgoing_documents.issued_by', '=', Auth::user()->id)
//                        ->where(function ($q) {
//                            $q->orwhere('dms_outgoing_documents.outgoing_document_privacy', '=', 'General');
//                        })
//                        ->where(function ($q) {
//                            $q->when('dms_outgoing_documents.outgoing_document_privacy==Departmental', function ($q) {
////
//                                $q->where('users.department_id', '=', Auth::user()->department_id);
//                            });
//                        })
//
//                        ->orwhere(function ($q) {
//                            $q->whereIn('dms_outgoing_documents.id', function ($query) {
//                                $query->select('dms_document_privacy.document_id')
//                                    ->from('dms_document_privacy')
//                                    ->where('dms_document_privacy.document_type', '=', 'outgoing')
//                                    ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
//                            });
//
//                        });
//
//                });

            $departmentQuery = clone $outgoingDocument;
            $confidentialQuery = clone $outgoingDocument;
            $outgoingDocument1 = $departmentQuery
                ->when('dms_outgoing_documents.outgoing_document_privacy==Departmental', function ($q) {
                    $q->where('users.department_id', '=', Auth::user()->department_id);

                })
                ->orderBy('dms_outgoing_documents.id', 'desc');


            $outgoingDocument2 = $confidentialQuery
                ->when('dms_outgoing_documents.outgoing_document_privacy==Departmental', function ($q) {


                    $q->whereIn('dms_outgoing_documents.id', function ($q) {
                        return $q->select('dms_document_privacy.document_id')
                            ->from('dms_document_privacy')
                            ->where('dms_document_privacy.document_type', '=', 'outgoing')
                            ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
                    });

                })->orderBy('dms_outgoing_documents.id', 'desc');



            if ($outgoingDocument2->count() != 0) {
//                $outgoingDocument=$outgoingDocument2->get()->merge($outgoingDocument1->get());
                $outgoingDocument = $outgoingDocument1->union($outgoingDocument2);



            } else {
                $outgoingDocument = $outgoingDocument1;
            }



//            $outgoingDocument=$outgoingDocument1->union($outgoingDocument2);


        }


        if ($request->has('search_field') && $request->search_field!=null) {
            $searchData = $request->get('search_field');
            $outgoingDocument = $outgoingDocument
                ->join('dms_document_tags', 'dms_document_tags.document_id', '=', 'dms_outgoing_documents.id')
                ->join('dms_tags', 'dms_tags.id', '=', 'dms_document_tags.tag_id')
                ->orWhere('dms_outgoing_documents.outgoing_document_subject', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_templates.template_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_institutions.institution_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('users.name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_tags.tag_name', 'LIKE', '%' . strtolower($searchData) . '%');

        }
        if ($request->has('folder_id') && $request->folder_id!=null) {
            $value = $request->folder_id;
            $outgoingDocument = $outgoingDocument->where('dms_outgoing_documents.folder_id', '=', $value );
        }
        if ($request->has('document_subject')) {
            $outgoingDocument = $outgoingDocument->where('dms_outgoing_documents.outgoing_document_subject', 'LIKE', '%' . $request->get('document_subject') . '%');
        }
        if ($request->has('institution_id')) {
            $outgoingDocument = $outgoingDocument->where('dms_outgoing_documents.institution_id', '=', $request->get('institution_id'));
      
        }
        if ($request->has('outgoing_document_status')) {
            $outgoingDocument = $outgoingDocument->where('dms_outgoing_documents.outgoing_issue_status', '=', $request->get('outgoing_document_status'));
        }
        if ($request->has('signed_user_id')) {
            $outgoingDocument = $outgoingDocument->where('dms_outgoing_documents.signature_user_id', '=', $request->get('signed_user_id'));
        }
        if ($request->has('issue_number')) {
            $outgoingDocument->where('dms_outgoing_documents.outgoing_issue_number', '=', $request->get('issue_number'));
        }
        if ($request->has('outgoing_registration_number')) {
            $outgoingDocument->where('dms_outgoing_documents.outgoing_registration_number', '=', $request->get('outgoing_registration_number'));
        }
        if ($request->has('outgoing_document_date_from') && $request->has('outgoing_document_date_to')) {
            if ($request->get('outgoing_document_date_from') > $request->get('outgoing_document_date_to')) {
                $outgoingDocument->whereBetween('dms_outgoing_documents.outgoing_document_date', array($request->get('outgoing_document_date_to'), $request->get('outgoing_document_date_from')));


            } else
                $outgoingDocument->whereBetween('dms_outgoing_documents.outgoing_document_date', array($request->get('outgoing_document_date_from'), $request->get('outgoing_document_date_to')));


        }
        if ($request->has('outgoing_document_date_from')) {
            $outgoingDocument->where('dms_outgoing_documents.outgoing_document_date', '>=', $request->get('outgoing_document_date_from'));
        }
        if ($request->has('outgoing_document_date_to')) {
            $outgoingDocument->where('dms_outgoing_documents.outgoing_document_date', '<=', $request->get('outgoing_document_date_to'));
        }

        return $outgoingDocument
            ;


    }

    public static function find($id)
    {
        if (User::isSuperAdmin()) {
            return OutgoingDocument::find($id);
        } else {
            $document = OutgoingDocument::join('users', 'users.id', 'dms_outgoing_documents.created_by_user_id')
                ->where('users.department_id', '=', Auth::user()->department_id)
                ->where('dms_outgoing_documents.id', '=', $id)
                ->select('dms_outgoing_documents.*');


            $documentPrivacy = OutgoingDocument::where('dms_outgoing_documents.outgoing_document_privacy', '=', 'General')
                ->where('dms_outgoing_documents.id', '=', $id);


            $documentAuthority = OutgoingDocument::
            where('dms_outgoing_documents.issued_by', '=', Auth::user()->id)
                ->where('dms_outgoing_documents.id', '=', $id)
                ->where('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id);

            $result = $document->union($documentPrivacy)->union($documentAuthority)
                ->where('dms_outgoing_documents.id', '=', $id)
                ->first();
            return $result;

//            $outgoingDocument = DB::table('dms_outgoing_documents')
//                ->join('dms_templates', 'dms_templates.id', '=', 'dms_outgoing_documents.template_id')
//                ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_outgoing_documents.institution_id')
//                ->join('users', 'users.id', '=', 'dms_outgoing_documents.created_by_user_id')
//                ->select('dms_outgoing_documents.*', 'dms_templates.*', 'dms_institutions.*', 'users.*', 'dms_outgoing_documents.id as id',
//                    'dms_outgoing_documents.created_at as created_at', 'dms_institutions.id as institution_id')
//                ->where('dms_outgoing_documents.deleted_at', '=', NULL)
//                ->where('dms_outgoing_documents.id', '=', $id);
//            $outgoingDocument->where('users.department_id', '=', Auth::user()->department_id);
//            $outgoingDocument->orwhere('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id);
//            $outgoingDocument->orwhere('dms_outgoing_documents.issued_by', '=', Auth::user()->id);
//
//            return $outgoingDocument
//                ->first();
        }


    }

    public function findById($id)
    {
        if (User::isSuperAdmin()) {
            return OutgoingDocument::find($id);
        } else {
            $document = OutgoingDocument::join('users', 'users.id', 'dms_outgoing_documents.created_by_user_id')
                ->where('users.department_id', '=', Auth::user()->department_id)
                ->where('dms_outgoing_documents.id', '=', $id)
                ->select('dms_outgoing_documents.*');


            $documentPrivacy = OutgoingDocument::where('dms_outgoing_documents.outgoing_document_privacy', '=', 'General')
                ->where('dms_outgoing_documents.id', '=', $id);


            $documentAuthority = OutgoingDocument::
            where('dms_outgoing_documents.issued_by', '=', Auth::user()->id)
                ->where('dms_outgoing_documents.id', '=', $id)
                ->where('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id);

            $result = $document->union($documentPrivacy)->union($documentAuthority)
                ->where('dms_outgoing_documents.id', '=', $id)
                ->first();
            return $result;
        }
    }

    public function getAllOutgoingDocumentByInstitution($institution_id)
    {
        if (User::isSuperAdmin()) {
            return $this->outgoingDocument
                ->join('dms_templates', 'dms_templates.id', '=', 'dms_outgoing_documents.template_id')
                ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_outgoing_documents.institution_id')
                ->join('users', 'users.id', '=', 'dms_outgoing_documents.created_by_user_id')
                ->where('dms_institutions.id', '=', $institution_id)
                ->select('dms_outgoing_documents.*', 'dms_templates.*', 'dms_institutions.*', 'users.*', 'dms_outgoing_documents.id as id',
                    'dms_outgoing_documents.created_at as created_at', 'dms_institutions.id as institution_id');
        } else {
            return $this->outgoingDocument
                ->join('dms_templates', 'dms_templates.id', '=', 'dms_outgoing_documents.template_id')
                ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_outgoing_documents.institution_id')
                ->join('users', 'users.id', '=', 'dms_outgoing_documents.created_by_user_id')
                ->where('dms_institutions.id', '=', $institution_id)
                ->where('users.department_id', '=', Auth::user()->department_id)
                ->orwhere('dms_outgoing_documents.outgoing_document_privacy', '=', 'General')
                ->orwhere('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id)
                ->orwhere('dms_outgoing_documents.issued_by', '=', Auth::user()->id)
                ->select('dms_outgoing_documents.*', 'dms_templates.*', 'dms_institutions.*', 'users.*', 'dms_outgoing_documents.id as id',
                    'dms_outgoing_documents.created_at as created_at', 'dms_institutions.id as institution_id');
        }


    }

    public function getDocumentByStatus($status)
    {
        $outgoingDocument = $this->outgoingDocument
            ->join('dms_templates', 'dms_templates.id', '=', 'dms_outgoing_documents.template_id')
            ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_outgoing_documents.institution_id')
            ->join('users', 'users.id', '=', 'dms_outgoing_documents.created_by_user_id')
            ->select('dms_outgoing_documents.*', 'dms_templates.*', 'dms_institutions.*', 'users.*',
                'dms_outgoing_documents.created_at as created_at', 'dms_institutions.id as institution_id', 'dms_outgoing_documents.id as id')
            ->where(function ($q) use ($status) {
                if ($status == 'issued') {
                    $q->where('dms_outgoing_documents.outgoing_issue_status', '=', 'issued');
                    $q->orwhere('dms_outgoing_documents.outgoing_issue_status', '=', 'registered');
                } else
                    $q->where('dms_outgoing_documents.outgoing_issue_status', $status);


            });

        if (User::isSuperAdmin()) {

            $outgoingDocument
                ->orderBy('dms_outgoing_documents.id', 'desc');
        } else {

            $outgoingDocument = $outgoingDocument
                ->where(function ($q) {
//
                    $q->where('dms_outgoing_documents.created_by_user_id', '=', Auth::user()->id)
                        ->orwhere('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id)
                        ->orwhere('dms_outgoing_documents.issued_by', '=', Auth::user()->id)
                        ->orwhere(function ($q) {
                            $q->where('dms_outgoing_documents.outgoing_document_privacy', '=', 'General');
                        })
                        ->orwhere('users.department_id', '=', Auth::user()->department_id)
                        ->orwhere(function ($q) {
                            $q->whereIn('dms_outgoing_documents.id', function ($query) {
                                $query->select('document_id')
                                    ->from('dms_document_privacy')
                                    ->where('dms_document_privacy.document_type', '=', 'outgoing')
                                    ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
                            });

                        });

                });

        }


        return $outgoingDocument
            ->orderBy('dms_outgoing_documents.id', 'desc')
            ->get();


    }

    public function getIssueNumber($template_id, $request_date)
    {
        
        /*Get current year and code*/

        $year = $this->fiscalYearRepository->getFiscalYear($request_date);
        if ($year != null) {
            $yearTitle = $year->fy_name;

            /* Get Max Serial Number from issues table*/
            $res_max =
                DB::table('dms_outgoing_documents')
                    ->where('outgoing_document_date', '>=', $year->fy_start_date)
                    ->where('outgoing_document_date', '<=', $year->fy_end_date)
                    ->max('outgoing_serial_number');

            $max_serial_number = isset($res_max) ? $res_max : 0;
            $next_serial_number = $max_serial_number + 1;
            /* Get template code by letter id*/


            $res_code = Template::find($template_id);

            $template_code = $res_code->template_short_name;

            $issueCode = $yearTitle . '-' . $template_code . '-' . $next_serial_number;

            return ['issue_code' => $issueCode,
                'next_serial_number' => $next_serial_number
            ];

        }
    }

    public function getDocumentByMonth($month)
    {
        if (User::isSuperAdmin()) {
            $documents = OutgoingDocument::where(DB::raw('YEAR(created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(created_at)'), '=', date('m', $month))
                ->select('created_at')
                ->get();
        } else {
            $outgoingDocument = $this->outgoingDocument
                ->join('dms_templates', 'dms_templates.id', '=', 'dms_outgoing_documents.template_id')
                ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_outgoing_documents.institution_id')
                ->join('users', 'users.id', '=', 'dms_outgoing_documents.created_by_user_id')
                ->select('dms_outgoing_documents.*', 'dms_templates.*', 'dms_institutions.*', 'users.*', 'dms_outgoing_documents.id as id',
                    'dms_outgoing_documents.created_at as created_at', 'dms_institutions.id as institution_id');


            $documents = $outgoingDocument
                ->where(DB::raw('YEAR(dms_outgoing_documents.created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(dms_outgoing_documents.created_at)'), '=', date('m', $month))
                ->where(function ($q) {
                    $q->where('users.department_id', '=', Auth::user()->department_id)
                        ->orwhere('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id);

                })
                ->where(function ($q) {
                    $q->where('users.department_id', '=', Auth::user()->department_id)
                        ->orwhere('dms_outgoing_documents.outgoing_document_privacy', '=', 'General');
                })
                ->where(function ($q) {
                    $q->where('users.department_id', '=', Auth::user()->department_id)
                        ->orwhere('dms_outgoing_documents.issued_by', '=', Auth::user()->id);
                })
                ->get();


        }

        return count($documents);

    }

    public function getIssuedDocumentByMonth($month)
    {
        if (User::isSuperAdmin()) {
            $documents = OutgoingDocument::where(DB::raw('YEAR(created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(created_at)'), '=', date('m', $month))
                ->where('outgoing_issue_status', '=', 'issued')
                ->select('created_at')
                ->get();
        } else {
            $outgoingDocument = $this->outgoingDocument
                ->join('dms_templates', 'dms_templates.id', '=', 'dms_outgoing_documents.template_id')
                ->join('dms_institutions', 'dms_institutions.id', '=', 'dms_outgoing_documents.institution_id')
                ->join('users', 'users.id', '=', 'dms_outgoing_documents.created_by_user_id')
                ->select('dms_outgoing_documents.*', 'dms_templates.*', 'dms_institutions.*', 'users.*', 'dms_outgoing_documents.id as id',
                    'dms_outgoing_documents.created_at as created_at', 'dms_institutions.id as institution_id');


            $documents = $outgoingDocument
                ->where(function ($q) {
                    $q->where('dms_outgoing_documents.outgoing_issue_status', '=', 'issued');
                    $q->orwhere('dms_outgoing_documents.outgoing_issue_status', '=', 'registered');

                })
                ->where(function ($q) {
                    $q->where('dms_outgoing_documents.created_by_user_id', '=', Auth::user()->id)
                        ->orwhere('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id)
                        ->orwhere('dms_outgoing_documents.issued_by', '=', Auth::user()->id)
                        ->orwhere(function ($q) {
                            $q->where('dms_outgoing_documents.outgoing_document_privacy', '=', 'General');
                        })
                        ->orwhere('users.department_id', '=', Auth::user()->department_id)
                        ->orwhere(function ($q) {
                            $q->whereIn('dms_outgoing_documents.id', function ($query) {
                                $query->select('document_id')
                                    ->from('dms_document_privacy')
                                    ->where('dms_document_privacy.document_type', '=', 'outgoing')
                                    ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
                            });

                        });

                })
                ->where(DB::raw('YEAR(dms_outgoing_documents.created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(dms_outgoing_documents.created_at)'), '=', date('m', $month))
                ->get();


        }

        return count($documents);

    }

}