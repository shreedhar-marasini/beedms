<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\DocumentCategoryRequest;
use App\Models\DigitizedDocument;
use App\Models\DocumentCategory;
use App\Models\IncomingDocument;
use App\Models\OutgoingDocument;
use App\Repository\Configuration\DocumentCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DocumentCategoryController extends BaseController
{
    /**
     * @var DocumentCategoryRepository
     */
    private $documentCategoryRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(DocumentCategoryRepository $documentCategoryRepository)
    {
        parent::__construct();
        $this->documentCategoryRepository = $documentCategoryRepository;
    }

    public function index()
    {
        $documentCategories = $this->documentCategoryRepository->all();
        $categoryParentList = $this->documentCategoryRepository->categoryParentList();
        $getParent = $this->documentCategoryRepository;
        return view('configurations.documentCategories.index', compact('documentCategories', 'categoryParentList', 'getParent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentCategoryRequest $request)
    {
        try {
            if($request['parent_id'] == null){
                $request['parent_id'] = 0;
            }
            $create = DocumentCategory::create($request->all());
            if ($create) {
                session()->flash('success', 'Document Category successfully created!');
                return back();
            } else {
                session()->flash('error', 'Document Category could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = (int)$id;
            $edits = $this->documentCategoryRepository->findById($id);
            if (count($edits) > 0) {
                $documentCategories = $this->documentCategoryRepository->all();
                $categoryParentList = $this->documentCategoryRepository->categoryParentList();
                $categoryParentList[0]=['id' => 0, 'category_name' => '-'];
                $getParent = $this->documentCategoryRepository;
                return view('configurations.documentCategories.index', compact('edits', 'documentCategories', 'categoryParentList', 'getParent'));
            } else {
                session()->flash('error', 'Id could not be obtained!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentCategoryRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $documentCategory = $this->documentCategoryRepository->findById($id);
            if ($documentCategory) {
                $documentCategory->fill($request->all())->save();
                session()->flash('success', 'Document Category updated successfully!');

                return redirect(route('documentCategory.index'));
            } else {

                session()->flash('error', 'Id could not be obtained!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $value = $this->documentCategoryRepository->findById($id);

            if ($value) {
                $parent_id = $value->id;
                $parent_value = DocumentCategory::where('parent_id', '=', $parent_id)->get();
                if (count($parent_value) > 0) {
                    session()->flash('error', 'This category is in use. Unable to delete');
                    return back();
                }
                $child = $value->id;
                $incoming = IncomingDocument::where('document_category_id',$child)->get();
                $digitized = DigitizedDocument::where('document_category_id',$child)->get();

                if(count($incoming)>0 || count($digitized)>0)
                {
                    session()->flash('error','This category is in use. Unable to delete!');
                    return back();
                }
                $value->delete();
                session()->flash('success', 'Document Category successfully deleted!');
                return back();

            } else {
                session()->flash('error', 'Document Category could not be deleted!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();
        }
    }

    public function status($id)
    {
        $id = (int)$id;
        $documentCategory = $this->documentCategoryRepository->findById($id);
        if ($documentCategory->category_status == 'active') {
            $status = 'inactive';
            session()->flash('status', 'Document Category Status Inactive!');
        } else {
            $status = 'active';
            session()->flash('status', 'Document Category Status Active!');
        }
        $documentCategory->category_status = $status;
        $documentCategory->save();
        return back();
    }

}
