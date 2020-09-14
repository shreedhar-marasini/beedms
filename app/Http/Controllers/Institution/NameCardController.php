<?php

namespace App\Http\Controllers\Institution;

use App\Http\Requests\Institution\NameCardRequest;
use App\Models\Institution;
use App\Models\NameCard;
use App\Repository\Institution\InstitutionRepository;
use App\Repository\Institution\NameCardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class NameCardController extends Controller
{
    private $nameCardRepository;
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;

    public function __construct(NameCardRepository $nameCardRepository,
                                InstitutionRepository $institutionRepository)
    {
        $this->nameCardRepository = $nameCardRepository;

        $this->institutionRepository = $institutionRepository;
    }

    public function index(Request $request)
    {
        $institutions = $this->institutionRepository->lists();
        $nameCardUsers = $this->nameCardRepository->all($request);
        return view('institution.nameCard.index', compact('institutions', 'nameCardUsers'));
    }

    public function edit(Request $request,$id)
    {
        $institutions = $this->institutionRepository->lists();
        $nameCardUsers = $this->nameCardRepository->all($request);
        $edits = NameCard::find($id);
        return view('institution.nameCard.index', compact('institutions', 'nameCardUsers', 'edits'));
    }

    public function create($id)
    {
        $institution = Institution::find($id);

        return view('institution.nameCard.add', compact('institution'));

    }

    public function store(NameCardRequest $request)
    {
        try {

            if ($request->all()) {
                $create = NameCard::create($request->all());
            }


            if ($create) {
                session()->flash('success', 'Name Card successfully created');
                return back();
            } else {
                session()->flash('error', 'Name Card could not be created');
                return back()->withInput();
            }


        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return redirect()->back()
                ->withInput()
                ->exceptInput('password', 'password_confirmation');;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $nameCard = NameCard::find($id);
            if ($nameCard) {

                $update = $nameCard->fill($request->all())->save();
                session()->flash('success', 'Name Card updated successfully');

                if (url()->previous() == url('name-card/' . $id . '/edit')) {
                    return redirect('name-card');

                } else {
                    return redirect()->back();
                }
            } else {
                session()->flash('error', 'Name Card could not be created');
                return back()->withInput();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $nameCard = NameCard::find($id);
        if ($nameCard) {

            $update = $nameCard->delete();
            session()->flash('success', 'Name Card deleted successfully');

            if (url()->previous() == url('name-card/' . $id . '/edit')) {
                return redirect('name-card');

            } else {
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Name Card could not be deleted');
            return back()->withInput();
        }
    }
    public function getNames(Request $request){

        return $this->nameCardRepository
            ->getCardUserNames($request);

    }
}
