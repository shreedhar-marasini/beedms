<?php

namespace App\Http\Controllers\Document\Folder;

use App\Http\Controllers\BaseController;
use App\Models\DigitizedDocument;
use App\Models\Folder;
use App\Models\IncomingDocument;
use App\Models\Institution;
use App\Models\OutgoingDocument;
use App\Repository\FolderRepository;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Parent_;

class FolderController extends BaseController
{
    /**
     * @var FolderRepository
     */
    private $folderRepository;
    /**
     * @var Folder
     */
    private $folder;

    /**
     * FolderController constructor.
     * @param FolderRepository $folderRepository
     */
    public function __construct(
        FolderRepository $folderRepository,
        Folder $folder
    )
    {
        parent::__construct();
        $this->folderRepository = $folderRepository;
        $this->folder = $folder;
    }

    public function index()
    {
    }

    public function store(Request $request)
    {

        dd($request);
        $folderName = $this->folderRepository->getFolderInstituteWise($request->institution_id, $request->name);
        if ($folderName->count() == 0) {
            $folder = Folder::create($request->all());
            return $folder;
        } else {
            $folder = $folderName->first();
            return response()->json($folder);
        }

    }

    public function update($id, Request $request)
    {
        $existingFolder = Folder::find($id);


        if ($existingFolder != null) {
            $folderName = $this->folderRepository->getFolderInstituteWise($request->institution_id, $request->name);

            if ($folderName->count() == 0) {
                $existingFolder['name'] = $request->name;
                $folder = $existingFolder->save();
                return response()->json($folder);
            } else {

                return response()->json('folder_exists');
            }
        } else {
            return response()->json('folder_doesnot_exists');

        }

    }

    public function getFolderList($folder_id = 0, $institution_id = 0)
    {

        $folder_id = (int)$folder_id;
        return $this->folderRepository->folderList($folder_id, $institution_id);
    }

    public function institutewiseFolderName($institution_id = 0, $folderName = null)
    {

        $institution_id = (int)$institution_id;
        $folderName = $this->folderRepository->getFolderInstituteWise($institution_id, $folderName);

        if ($folderName->count() != 0) {
            echo '<option>Already Exists Folder names</option>';

            foreach ($folderName as $name) {
                echo '<option>' . $name->name . '</option>';
            }
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($id != null) {
            $existingFolder = Folder::find($id);
            if ($existingFolder != null) {
                $incoming = IncomingDocument::where('folder_id', '=', $id)->get()->count();
                $outgoing = OutgoingDocument::where('folder_id', '=', $id)->get()->count();
                $digitized = DigitizedDocument::where('folder_id', '=', $id)->get()->count();
                if ($incoming != 0 || $outgoing != 0 || $digitized != 0) {
                    return response()->json('document_exists');

                } else {

                    $existingFolder->delete();
                    return response()->json('folder_deleted');

                }

            }
            return response()->json('folder_not_exists');
        }
    }
}

