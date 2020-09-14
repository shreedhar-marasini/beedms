<?php

namespace App\Http\Controllers\Documents;

use App\Models\DigitizedDocument;
use App\Models\IncomingDocument;
use App\Models\OutgoingDocument;
use App\Repository\Documents\DigitizedDocumentRepo;
use App\Repository\Documents\IncomingDocumentRepo;
use App\Repository\Documents\OutgoingDocumentRepository;
use App\Repository\FolderRepository;
use App\Repository\Institution\InstitutionRepository;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * @var OutgoingDocumentRepository
     */
    private $outgoingDocumentRepository;
    /**
     * @var IncomingDocumentRepo
     */
    private $incomingDocumentRepo;
    /**
     * @var DigitizedDocumentRepo
     */
    private $digitizedDocumentRepo;
    /**
     * @var FolderRepository
     */
    private $folderRepository;
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;

    /**
     * DocumentController constructor.
     */
    public function __construct(OutgoingDocumentRepository $outgoingDocumentRepository,
                                IncomingDocumentRepo $incomingDocumentRepo,
                                DigitizedDocumentRepo $digitizedDocumentRepo,
                                FolderRepository $folderRepository,
                                InstitutionRepository $institutionRepository)
    {
        $this->middleware('auth');
        $this->outgoingDocumentRepository = $outgoingDocumentRepository;
        $this->incomingDocumentRepo = $incomingDocumentRepo;
        $this->digitizedDocumentRepo = $digitizedDocumentRepo;
        $this->folderRepository = $folderRepository;
        $this->institutionRepository = $institutionRepository;
    }

    public function search(Request $request)
    {
        $search_term = $request->get('search_field');
        $incomingDocuments = $this->incomingDocumentRepo->getfilter($request)->get();
        $outgoingDocuments = $this->outgoingDocumentRepository->all($request)->get();
        $digitizedDocuments = $this->digitizedDocumentRepo->getDigitizedDocument($request)->get();
        if ($request->search_field == null) {
            $incomingDocuments = null;
            $outgoingDocuments = null;
            $digitizedDocuments = null;
        }
        $noavailableMessage = 'No records found';
        return view('documents.search.search', compact('incomingDocuments', 'outgoingDocuments', 'digitizedDocuments', 'search_term', 'noavailableMessage'));
    }

    public function getBackup()
    {
        // create a list of files that should be added to the archive.
        $files = glob(storage_path("app/public/uploads/documents/*"));
        // define the name of the archive and create a new ZipArchive instance.
//        if (file_exists(public_path('backup.zip'))) {
//            unlink('backup.zip');
//        }



        if ($files != null) {
            foreach ($files as $file) {
                // Find parent dir for reference


                $filePath = explode('/', $file);
                //list all file of google drive to check if the directory exists
                $folder = end($filePath);
           
                // Get root directory contents...
                $contents = collect(Storage::drive('google')->listContents('/', false));
    
                // Find the folder you are looking for...
                $dir = $contents->where('type', '=', 'dir')
                    ->where('filename', '=', $folder)
                    ->first(); // There could be duplicate directory names!

                if (!$dir) {
                    Storage::drive('google')->makeDirectory($folder);
                } else {
                    $fileContents = glob(storage_path("app/public/uploads/documents/" . $folder . "/*"));
                    foreach ($fileContents as $fileContent) {
                        if ($fileContent != null) {
                            $filename = explode('/', $fileContent);
                            $filename = end($filename);
                        }
                        // Get the files inside the folder...
                        $files = collect(Storage::drive('google')->listContents($dir['path'], false))
                            ->where('type', '=', 'file')
                            ->where('name', '=', $filename);

//newest file

                        if (count($files) == 0) {

                            Storage::drive('google')->put($dir['path'] . '/' . $filename, $fileContent);
                        }
// else {
////file already exists in google drive and check if the file size is different upload only if file size is different
//                            dd(filesize($fileContent));
//
//                            dd($files[0]['size']!= filesize($fileContent));
//
//
//                        }

//    $files->mapWithKeys(function ($file) {
//        $filename = $file['filename'] . '.' . $file['extension'];
//        $path = $file['path'];
//        // Use the path to download each file via a generated link..
//        // Storage::cloud()->get($file['path']);
//        dd($path);
//        return [$filename => $path];
//    });

                    }


                }

            }
        }


//


//        $file = Zipper::make('backup.zip')->add($files)->close();
//        Storage::disk('google')->put('backup.zip', file_get_contents('backup.zip'));
        return ('successfully backup the data');

    }

    public function getFolders(Request $request)
    {
        $folders = $this->folderRepository->getAllFolders($request->name, $request->institution_id);
        $institutions = $this->institutionRepository->lists();

        return view('documents.folder.index', compact('folders', 'institutions'));
    }

    public function getFoldersById($folderId, Request $request)
    {
        $request['folder_id'] = $folderId;
        $request['search_field'] = NULL;
        $folders = $this->folderRepository->getAllFolders();
        $incomingDocuments = $this->incomingDocumentRepo->getfilter($request)->get();
        $outgoingDocuments = $this->outgoingDocumentRepository->all($request)->get();
        $digitizedDocuments = $this->digitizedDocumentRepo->getDigitizedDocument($request)->get();
        $search_term = '';
        $folder = $this->folderRepository->getFolderById($folderId);
        $noavailableMessage = 'Empty';
        $institutions = $this->institutionRepository->lists();

        return view('documents.folder.show', compact('folder', 'folders', 'incomingDocuments', 'outgoingDocuments', 'digitizedDocuments', 'search_term', 'noavailableMessage','institutions'));
    }

    public function updateDocumentFolderId(Request $request)
    {
        if ($request->docType == 'digitized') {
            $digitizedDocument = DigitizedDocument::find($request->document_id);
            if ($digitizedDocument != null) {
                $digitizedDocument['folder_id'] = $request->folder_id;
                $digitizedDocument->save();
            }
        } elseif ($request->docType == 'outgoing') {
            $outgoingDocument = OutgoingDocument::find($request->document_id);
            if ($outgoingDocument != null) {
                $outgoingDocument['folder_id'] = $request->folder_id;
                $outgoingDocument->save();
            }
        } elseif ($request->docType == 'incoming') {
            $incomingDocument = IncomingDocument::find($request->document_id);
            if ($incomingDocument != null) {
                $incomingDocument['folder_id'] = $request->folder_id;
                $incomingDocument->save();
            }
        }
        return response()->json('success');

    }
}
