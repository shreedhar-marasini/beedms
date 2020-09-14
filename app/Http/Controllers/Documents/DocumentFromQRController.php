<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\CollectiveFunctionController;
use App\Models\OutgoingDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentFromQRController extends Controller
{
    /**
     *
     */
    private $collectiveFunctionController;

    public function __construct(CollectiveFunctionController $collectiveFunctionController){

        $this->collectiveFunctionController = $collectiveFunctionController;
    }


    public function getDocument($id){
        $document=OutgoingDocument::where('document_qr_code','=',$id)->first();


        if($document!=null)
        {
          $this->collectiveFunctionController->generatePDF($id, null, null, 'outgoing', 1, $document->id);
        }
        else{
            return view('404');
        }

    }
}
