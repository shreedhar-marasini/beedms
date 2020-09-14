<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DocumentBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Document Backup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

    }
}
