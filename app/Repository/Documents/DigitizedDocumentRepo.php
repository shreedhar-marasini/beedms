<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 8/13/17
 * Time: 4:44 PM
 */

namespace App\Repository\Documents;


use App\Models\DigitizedDocument;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DigitizedDocumentRepo
{
    /**
     * @var DigitizedDocument
     */
    private $digitizedDocument;


    /**
     * DigitalizedDocumentRepo constructor.
     */
    public function __construct(DigitizedDocument $digitizedDocument)
    {

        $this->digitizedDocument = $digitizedDocument;
    }


    public function all(){
        return $this->digitizedDocument->orderBy('id', 'DESC');
    }

    public function getDigitizedDocument($request){
        $department = Auth::user()->department_id;
        if (User::isSuperAdmin()) {
            $document =  $this->digitizedDocument;

        } else {
//            $document = $this->digitizedDocument
//                ->where(function ($q) use ($department) {
//                    $q->Where('uploaded_by_user_id', Auth::user()->id)
//                        ->orwhere('department_id', $department)
//                        ->orwhere(function ($query) {
//                            $query->orWhere('digitized_document_privacy', 'General');
//                        })
//                        ->orwhere(function ($query) {
//                            $query->whereIn('dms_digitized_documents.id', function ($q) {
//                                $q->select('document_id')
//                                    ->from('dms_document_privacy')
//                                    ->where('dms_document_privacy.document_type', '=', 'digitized')
//                                    ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
//                            });
//                        });
//                });

            $document =  $this->digitizedDocument;


            $departmentQuery = clone $document;
            $confidentialQuery = clone $document;
            $digitizedDocument1 = $departmentQuery
                ->when('dms_incoming_documents.digitized_document_privacy==Departmental', function ($q) {
                    $q->where('department_id', '=', Auth::user()->department_id);

                })
                ->orderBy('dms_digitized_documents.id', 'desc');


            $digitizedDocument2 = $confidentialQuery
                ->when('dms_digitized_documents.digitized_document_privacy==Departmental', function ($q) {


                    $q->whereIn('dms_digitized_documents.id', function ($q) {
                        return $q->select('dms_document_privacy.document_id')
                            ->from('dms_document_privacy')
                            ->where('dms_document_privacy.document_type', '=', 'digitized')
                            ->where('dms_document_privacy.user_id', '=', Auth::user()->id);
                    });

                })->orderBy('dms_digitized_documents.id', 'desc');



            if ($digitizedDocument2->count() != 0) {
//                $outgoingDocument=$digitizedDocument2->get()->merge($digitizedDocument1->get());
                $document = $digitizedDocument1->union($digitizedDocument2);



            } else {
                $document = $digitizedDocument1;
            }
        }

        if($request->has('search_field') && $request->search_field!=null){
            $searchData = $request->get('search_field');
            $document= $document
                ->join('dms_institutions','dms_institutions.id','=','dms_digitized_documents.related_institution_id')
                ->join('dms_document_tags', 'dms_document_tags.document_id', '=', 'dms_digitized_documents.id')
                ->join('dms_tags', 'dms_tags.id', '=', 'dms_document_tags.tag_id')
                ->join('dms_document_categories','dms_document_categories.id','=','dms_digitized_documents.document_category_id')
                ->join('users','users.id','=','dms_digitized_documents.uploaded_by_user_id')
                ->join('departments','departments.id','=','dms_digitized_documents.department_id')
                ->orWhere('dms_digitized_documents.digitized_document_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_document_categories.category_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('departments.department_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_institutions.institution_name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('users.name', 'LIKE', '%' . $searchData . '%')
                ->orWhere('dms_tags.tag_name', 'LIKE', '%' . strtolower($searchData) . '%');

        }
        if ($request->has('folder_id') && $request->folder_id!=null) {
            $value = $request->folder_id;
            $document = $document->where('dms_digitized_documents.folder_id', '=', $value );
        }


        if ($request->has('document_name')){
            $document=$document->where('dms_digitized_documents.digitized_document_name','LIKE','%'.$request->get('document_name').'%');
        }
        if ($request->has('document_category_id')){
            $document=$document->where('dms_digitized_documents.document_category_id',$request->get('document_category_id'));
        }
        if ($request->has('department_id')){
            $document=$document->where('dms_digitized_documents.department_id',$request->get('department_id'));
        }
        if ($request->has('related_institution_id')){
            $document=$document->where('dms_digitized_documents.related_institution_id',$request->get('related_institution_id'));
        }
        if ($request->has('digitized_document_date_from')&&$request->has('digitized_document_date_to') ) {
            if($request->get('digitized_document_date_from')>$request->get('digitized_document_date_to')) {
                $document->where('dms_digitized_documents.digitized_document_date', '<=', $request->get('digitized_document_date_from'))
                    ->where('dms_digitized_documents.digitized_document_date', '>=', $request->get('digitized_document_date_to'));
            }

            else {
                $document->whereBetween('dms_digitized_documents.digitized_document_date',array($request->digitized_document_date_from, $request->digitized_document_date_to));

            }


        }
        if ($request->has('digitized_document_date_from')&& $request->get('digitized_document_date_from')!=''&&$request->has('digitized_document_date_to')=='') {

            $document->where('dms_digitized_documents.digitized_document_date', '>=', $request->get('digitized_document_date_from'));
        }
        if ($request->has('digitized_document_date_to')&&$request->get('digitized_document_date_from')==''&&$request->has('digitized_document_date_to')!='') {
            $document->where('dms_digitized_documents.digitized_document_date', '<=', $request->get('digitized_document_date_to'));
        }
        return $document->orderBy('dms_digitized_documents.id','desc');
    }




        public function findById($id)
        {
            $value= Self::checkAccess($id);
            return $value;
        }



    public function checkAccess($id)
    {
        $department = Auth::user()->department_id;
        if (User::isSuperAdmin()) {
            return $this->digitizedDocument
                ->find($id);

        } else {
            $document = DigitizedDocument::where('department_id', '=', $department)
                ->where('id', '=', $id);

            $user = DigitizedDocument::where('uploaded_by_user_id',Auth::user()->id)
                ->where('id', '=', $id);

            $documentPrivacy = DigitizedDocument::where('digitized_document_privacy', '=', 'General')
                ->where('id', '=', $id);

            return  $document->union($documentPrivacy)->union($user)
                ->where('id', '=', $id)
                ->first();

        }
    }


    public function getAllDigitizeDocumentByInstitution($id)
    {
        $department = Auth::user()->department_id;
        if (User::isSuperAdmin()) {
            $document =  $this->digitizedDocument
                ->orderBy('id', 'DESC');

        } else {
            $document = $this->digitizedDocument
                ->where('department_id',$department)
                ->orWhere('digitized_document_privacy','General')
                ->orWhere('uploaded_by_user_id',Auth::user()->id)
                ->orderBy('id', 'DESC');
        }

        return $document->where('related_institution_id','=',$id);

    }
    public function getDocumentByMonth($month)
    {
        if(User::isSuperAdmin()) {

            $letters = DigitizedDocument::where(DB::raw('YEAR(created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(created_at)'), '=', date('m', $month))
                ->select('created_at')
                ->get();
        }
        else{
            $letters =$this->digitizedDocument
                ->join('users','users.id','=','dms_digitized_documents.uploaded_by_user_id')
                ->where(function ($q) {
                    $q->where('dms_digitized_documents.uploaded_by_user_id', '=', Auth::user()->id)
                        ->orwhere(function ($q) {
                            $q->where('dms_digitized_documents.digitized_document_privacy', '=', 'General');
                        })
                        ->orwhere('users.department_id', '=', Auth::user()->department_id)
                        ->orwhere(function ($q) {
                            $q->whereIn('dms_digitized_documents.id', function($query){
                                $query->select('document_id')
                                    ->from('dms_document_privacy')
                                    ->where('dms_document_privacy.document_type','=','digitized')
                                    ->where('dms_document_privacy.user_id','=',Auth::user()->id);
                            });

                        });

                }) ->where(DB::raw('YEAR(dms_digitized_documents.created_at)'), '=', date('Y', $month))
                ->where(DB::raw('MONTH(dms_digitized_documents.created_at)'), '=', date('m', $month))
                ->select('dms_digitized_documents.created_at')
                ->get();
        }
        return count($letters);

    }

}