<?php
/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 8/13/17
 * Time: 10:10 AM
 */

namespace App\Repository\Documents;

use App\Models\DigitizedDocument;
use App\Models\DocumentComment;
use Illuminate\Support\Facades\Auth;


class DocumentCommentRepository
{
    /**
     * @var DocumentComment
     */
    private $documentComment;

    public function __construct(DocumentComment $documentComment)
    {

        $this->documentComment = $documentComment;
    }

    public function getOutgoingDocumentCommentsById($id)
    {
        return DocumentComment::with('user')
            ->where('document_comments_type', '=', 'outgoing')
            ->where('documents_id', '=', $id)
            ->get();
    }

    public function getDigitizedDocumentCommentsById($id)
    {
        return DocumentComment::with('user')
            ->where('document_comments_type', '=', 'digitized')
            ->where('documents_id', '=', $id)
            ->get();
    }

    public function create(){
       return $this->documentComment
            ->add();
    }

    public function getIncomingDocumentCommentsById($id)
    {
        return DocumentComment::with('user')
            ->where('document_comments_type', '=', 'incoming')
            ->where('documents_id', '=', $id)
            ->get();
    }
   public function all(){
return DocumentComment::
    orderBy('id','desc')
    ->get();
       /*SELECT * FROM `dms_document_comments` WHERE
       documents_id IN(SELECT id FROM `dms_outgoing_documents` WHERE ((created_by_user_id=3 OR signature_user_id=3 OR issued_by=3) OR outgoing_document_privacy = 'General') OR(created_by_user_id IN(select id FROM users where department_id=1)) OR id IN(SELECT document_id FROM dms_document_privacy where document_type = 'Outgoing' AND user_id=3) ORDER by id desc) and document_comments_type = 'outgoing'*/
//      $outgoingDocument= $this->documentComment
//          ->where(function ($q) {
//               $q->whereIn('document_id', function($query){
//                   $query->select('id')
//                       ->from('dms_outgoing_documents')
//                       ->where(function($q){
//                           $q->where('dms_outgoing_documents.created_by_user_id', '=', Auth::user()->id)
//                               ->orwhere('dms_outgoing_documents.signature_user_id', '=', Auth::user()->id)
//                               ->orwhere('dms_outgoing_documents.issued_by', '=', Auth::user()->id)
//                               ->orwhere(function ($q) {
//                                   $q->where('dms_outgoing_documents.outgoing_document_privacy', '=', 'General');
//                               })
//                               ->orwhere('users.department_id', '=', Auth::user()->department_id)
//                               ->orwhere(function ($q) {
//                                   $q->whereIn('dms_outgoing_documents.id', function($query){
//                                       $query->select('document_id')
//                                           ->from('dms_document_privacy')
//                                           ->where('dms_document_privacy.document_type','=','outgoing')
//                                           ->where('dms_document_privacy.user_id','=',Auth::user()->id);
//                                   });
//
//                               });
//                       });
//
//               });
//
//           })->select('id');
//       $incomingDocument=DocumentComment::where(function ($q) {
//           $q->whereIn('document_id', function($query){
//               $query->select('id')
//                   ->from('dms_incoming_documents')
//                   ->where(function($q){
//                       $q->where('dms_incoming_documents.uploaded_by', '=', Auth::user()->id)
//                           ->orwhere('receiver_department_id', '=', Auth::user()->department_id)
//                           ->orwhere(function ($q) {
//                               $q->where('dms_incoming_documents.outgoing_document_privacy', '=', 'General');
//                           })
//                           ->orwhere(function ($q) {
//                               $q->whereIn('dms_incoming_documents.id', function($query){
//                                   $query->select('document_id')
//                                       ->from('dms_document_privacy')
//                                       ->where('dms_document_privacy.document_type','=','incoming')
//                                       ->where('dms_document_privacy.user_id','=',Auth::user()->id);
//                               });
//
//                           });
//                   });
//           });
//
//       })->select('id');






   }
}