<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\TagRequest;
use App\Models\DigitizedDocument;
use App\Models\IncomingDocument;
use App\Models\Tag;
use App\Repository\Configuration\TagRepository;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TagController extends BaseController
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->all();
        return view('configurations.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try {
            $tagName = Tag::where(DB::raw(' LOWER(`tag_name`)'), strtolower($request->tag_name))
                ->select('id', 'tag_name')
                ->orderBy('tag_name', 'Asc')
                ->get();

            if ($tagName->count() == 0) {
                $create = Tag::create($request->all());
            }
            else{
                $create=$tagName->first();
            }
            if ($create) {

                /* AJAX check  */
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    /* special ajax here */
                    return response()->json($create);
                } else {
                    session()->flash('success', 'Tag successfully created!');
                    return back();
                }
            } else {
                session()->flash('error', 'Tag could not be created!');
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
            $edits = $this->tagRepository->findById($id);
            if (count($edits) > 0) {
                $tags = $this->tagRepository->all();
                return view('configurations.tags.index', compact('edits', 'tags'));
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
    public function update(TagRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $tag = $this->tagRepository->findById($id);
            if ($tag) {

                $tag->fill($request->all())->save();
                session()->flash('success', 'Tag updated successfully!');

                return redirect(route('tag.index'));
            } else {

                session()->flash('error', 'No record with given id!');
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
            $value = $this->tagRepository->findById($id);
            if ($value) {
                $valueId = $value->id;
                $tag = DB::table('dms_document_tags')->where('tag_id', $valueId)->get();

                if (count($tag) > 0) {
                    session()->flash('error', 'Tag is in use. Unable to delete!');
                    return back();
                }
                $value->delete();
                session()->flash('success', 'Tag successfully deleted!');
                return back();
            } else {
                session()->flash('error', 'Tag could not be deleted!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }


    public function searchTag()
    {
        $searchTerm = Input::get("q");
        $results = $this->tagRepository->searchTag($searchTerm)->get();
        return response()->json($results);
    }

    public function searchTagList($name)
    {
        $searchTerm = Input::get("name");
        $results = $this->tagRepository->searchTag($searchTerm)->get();
        foreach ($results as $result) {
            echo '<option>' . $result->tag_name . '</option>';
        }
    }
}
