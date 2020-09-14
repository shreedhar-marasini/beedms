<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\TemplateRequest;
use App\Models\DigitizedDocument;
use App\Models\OutgoingDocument;
use App\Models\Template;
use App\Repository\Configuration\DocumentCategoryRepository;
use App\Repository\Configuration\TemplateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;

class TemplateController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $templateRepository;
    /**
     * @var DocumentCategoryRepository
     */
    private $documentCategoryRepository;

    public function __construct(TemplateRepository $templateRepository, DocumentCategoryRepository $documentCategoryRepository)
    {
        parent::__construct();
        $this->templateRepository = $templateRepository;
        $this->documentCategoryRepository = $documentCategoryRepository;
    }

    public function index()
    {
        $templates = $this->templateRepository->all();
        $documentCategoryList = $this->documentCategoryRepository->all();
        
        return view('configurations.templates.index', compact('templates', 'documentCategoryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentCategoryRepo = $this->documentCategoryRepository;
        return view('configurations.templates.add', compact('documentCategoryRepo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        $request['template_content'] = $request->editor1;
        Template::create($request->all());
        session()->flash('success', 'Template successfully added');
        if ($request->save == "save") {

            return redirect('configurations/template');
        } else {
            return redirect('configurations/template/create');
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
        $template = Template::with('document_categories')->find($id);
        return view('configurations.templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edits = Template::find($id);
        $documentCategoryRepo = $this->documentCategoryRepository;
        return view('configurations.templates.edit', compact('edits', 'documentCategoryRepo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, $id)
    {
        try {
            $edits = Template::find($id);
            $request['template_content'] = $request->editor1;
            $update = $edits->fill($request->all())->save();
            if ($update) {
                session()->flash('success', 'Template successfully Updated');
                if ($request->save == "save") {

                    return redirect('configurations/template');
                } else {

                    return redirect('configurations/template');
                }
            } else {
                session()->flash('error', 'Template could not be Update');
                return back();


            }
        } catch
        (Exception $e) {
            return $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $id = (int)$id;
        try {
            $value = Template::find($id);

            if ($value) {
                $valueId = $value->id;
                $useTemplate = OutgoingDocument::where('template_id', $valueId)->get();
                $digitizeduseTemplate=DigitizedDocument::where('template_id',$valueId)->get();

                if (count($useTemplate) > 0 || count($digitizeduseTemplate)>0) {
                    session()->flash('error', 'Template is in use. Unable to delete!');
                    return back();
                }
                else {
                    $value->delete();
                  
                        session()->flash('success', 'Template successfully deleted');
                        return back();
                  
                }
            } else {
                session()->flash('error', 'Template could not found');
                return back();
            }

        } catch
        (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }

}
