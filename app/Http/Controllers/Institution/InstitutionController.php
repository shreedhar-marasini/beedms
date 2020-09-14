<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\BaseController;
use App\Models\DigitizedDocument;
use App\Models\IncomingDocument;
use App\Models\Institution;
use App\Models\OutgoingDocument;
use App\Repository\Documents\DigitizedDocumentRepo;
use App\Repository\Documents\IncomingDocumentRepo;
use App\Repository\Documents\OutgoingDocumentRepository;
use App\Repository\Institution\InstitutionRepository;
use App\Repository\Institution\NameCardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Http\Requests\Institution\InstitutionRequest;

class InstitutionController extends BaseController
{
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;
    /**
     * @var IncomingDocumentRepo
     */
    private $incomingDocumentRepo;
    /**
     * @var OutgoingDocumentRepository
     */
    private $outgoingDocumentRepository;
    /**
     * @var NameCardRepository
     */
    private $nameCardRepository;
    /**
     * @var DigitizedDocumentRepo
     */
    private $digitizedDocumentRepo;

    public function __construct(
        InstitutionRepository $institutionRepository,
        IncomingDocumentRepo $incomingDocumentRepo,
        NameCardRepository $nameCardRepository,
        OutgoingDocumentRepository $outgoingDocumentRepository,
        DigitizedDocumentRepo $digitizedDocumentRepo
    )
    {
        parent::__construct();
        $this->institutionRepository = $institutionRepository;
        $this->incomingDocumentRepo = $incomingDocumentRepo;
        $this->outgoingDocumentRepository = $outgoingDocumentRepository;
        $this->nameCardRepository = $nameCardRepository;
        $this->digitizedDocumentRepo = $digitizedDocumentRepo;
    }

    public function index(Request $request)
    {
        $institutions = $this->institutionRepository->all($request);
        return view('institution.index', compact('institutions'));

    }

    public function store(InstitutionRequest $request)
    {
        try {
            $store = Institution::create($request->all());
            if ($store) {
                session()->flash('success', 'Institution successfully created!');
                return back();
            } else {
                session()->flash('error', 'Institution could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }

    }

    public function edit(Request $request, $id)
    {
        $edits = Institution::find($id);
        $institutions = $this->institutionRepository->all($request);
        if ($edits) {
            return view('institution.index', compact('edits', 'institutions'));
        } else
            session()->flash('error', ' could not find the data!');
        return back();
    }

    public function update($id, InstitutionRequest $request)
    {
        try {
            $institution = Institution::find($id);
            $store = $institution->fill($request->all())->save();
            if ($store) {
                session()->flash('success', 'Institution successfully updated!');
                return redirect('institution');

            } else {
                session()->flash('error', 'Institution could not be created!');
                return back();

            }

        } catch (\Exception $e) {
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }
    public function show($id)
    {
        $institution=Institution::find($id);
        $incomingDocuments=$this->incomingDocumentRepo->getAllIncomingDocumentByInstitution($id)->get();
        $outgoingDocuments=$this->outgoingDocumentRepository->getAllOutgoingDocumentByInstitution($id)->get();
        $digitizedDocuments=$this->digitizedDocumentRepo->getAllDigitizeDocumentByInstitution($id)->get();
        $nameCards=$this->nameCardRepository->getNameCardByInstitution($id)->get();
        $timelineDate = $this->institutionRepository->getDocumentDate($id);
        return view('institution.show',compact('institution','incomingDocuments','outgoingDocuments','nameCards','timelineDate','digitizedDocuments'));
    }

    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $institution = Institution::find($id);
            if ($institution) {
                $institutionId = $institution->id;
                $incoming = IncomingDocument::where('sender_institution_id',$institutionId)->get();
                $digitized = DigitizedDocument::where('related_institution_id',$institutionId)->get();
                $outgoing = OutgoingDocument::where('institution_id',$institutionId)->get();

                if(count($incoming)>0 || count($digitized)>0 || count($outgoing)>0)
                {
                    session()->flash('error','Institution is in use. Unable to delete!');
                    return back();
                }
                $institution->delete();
                session()->flash('success', 'Institution successfully deleted!');
                return back();
            }
            else {
                session()->flash('error', 'Institution could not be deleted!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }
    public function getInstitutionNames(Request $request){

        return $this->institutionRepository
            ->getInstitutionName($request);

    }

}
