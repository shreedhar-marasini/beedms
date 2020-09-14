<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 7/27/17
 * Time: 4:21 PM
 */

namespace App\Repository;


use App\Models\Folder;
use App\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Self_;

class FolderRepository
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var Folder
     */
    private $folder;

    public function __construct(Folder $folder)
    {
        $this->folder = $folder;
    }

    public function getAllFolders($folder_name = 0, $instituion_id = 0)
    {
        $institution = $this->folder
            ->join('dms_institutions', 'dms_institutions.id', '=', 'folders.institution_id');
          
        if ($instituion_id != 0 || $instituion_id != null) {
            $institution = $institution
                ->where('institution_id', $instituion_id);
            
        }
        $institution = $institution
            ->distinct('institution_id')
            ->orderBy('dms_institutions.institution_name', 'ASC')
            ->get();

        foreach ($institution as $ins) {
            $folders[$ins->institution_name] = $this->folder
                ->where('institution_id', $ins->id);
            if ($folder_name != null) {
                $folders[$ins->institution_name] = $folders[$ins->institution_name]
                    ->where('name', 'like', '%' . $folder_name);
            }
            $folders[$ins->institution_name] = $folders[$ins->institution_name]
                ->orderBy('name', 'Asc')
                ->get();
        }
        $folders['noInstitute'] = $this->folder
            ->where('institution_id', '=', 0)
            ->orderBy('name', 'Asc')
            ->get();

        return $folders;
    }

    public function getFolderById($id)
    {
        $folders = $this->folder
            ->where('id', '=', $id)
            ->first();

        return $folders;
    }

    public function getFolderInstituteWise($institution_id, $folder_name)
    {
        
        $folders = $this->folder;
        if ($institution_id > 0) {
            $folders = $folders
                ->where('institution_id', '=', $institution_id);
        }
        if ($folder_name != null) {
            $folders = $folders
                ->where(DB::raw(' LOWER(`name`)'), strtolower($folder_name));
        }
        $folders = $folders->select('id', 'name')
            ->orderBy('name', 'Asc')
            ->get();

        return $folders;
    }

    public function folderList($select, $institution_id)
    {
        $folders = $this->folder;
        if ($institution_id > 0) {
            $folders = $folders
                ->where('institution_id', '=', $institution_id);
        }
        $folders = $folders
            ->select('id', 'name')
            ->orderBy('name', 'Asc')
            ->get();


//        echo '<select name="folder_id" id="folder_id" class="form-group" style="width: 100%;">';

        echo '<option value="0">Select Folder Name</option>';
        foreach ($folders as $folder) {
            if ($select == $folder->id) {
                $selected = 'selected';
            } else {
                $selected = '';

            }
            echo '<option value="' . $folder->id . '"' . $selected . '>' . $folder->name . '</option>';

        }
//        echo '</select>';
    }


}