<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/1/17
 * Time: 5:30 PM
 */

namespace App\Repository\Configuration;


use App\Models\DocumentCategory;
use Illuminate\Support\Facades\DB;

class DocumentCategoryRepository
{


    /**
     * @var DocumentCategory
     */
    private $documentCategory;

    public function __construct(DocumentCategory $documentCategory)
    {

        $this->documentCategory = $documentCategory;
    }

    public function all()
    {
        $documentCategories = $this->documentCategory->orderBy('category_name','asc')->get();
        return $documentCategories;
    }

    public function categoryParentList()
    {
        $parent = $this->documentCategory
            ->select('id', 'category_name')
            ->orderBy('id', 'DESC')
            ->get();
        return $parent;
    }

    public function getParentName($id)
    {
        $parentName = $this->documentCategory->find($id);
        return $parentName->category_name;
    }

    public  function getAllChild(){
        $children=$this->documentCategory->select('id', 'category_name')
            ->orderBy('category_name', 'ASC')
            ->where('parent_id','!=',0)
            ->get();
        return $children;
    }

    public function findById($id)
    {
        $documentCategory = $this->documentCategory->find($id);
        return $documentCategory;
    }

    public function getDocumentCategoryList($selectedId = 0)
    {
        $documentCategories = $this->documentCategory
            ->select('category_name', 'id')
            ->where('parent_id', '=', 0)
            ->orderBy('category_name', 'ASC')
            ->get();
        $list = '';
        foreach ($documentCategories as $documentCategory) {
            $select = ($selectedId == $documentCategory->id) ? 'selected' : null;
            $list .= "<option value = " . $documentCategory->id . " style='font-weight:bolder;' " . $select . "disabled>" . $documentCategory->category_name . "</option>";
            $levelOne = $this->documentCategory
                ->select('category_name', 'id')
                ->where('parent_id', '=', $documentCategory->id)
                ->orderBy('category_name', 'ASC')   
                ->get();
            foreach ($levelOne as $one) {
                $levelOneSelect = ($selectedId == $one->id) ? 'selected' : null;
                $list .= "<option value=" . $one->id . " " . $levelOneSelect . "> &emsp;" . $one->category_name . "</option>";
            }
        }

        echo $list;
    }
}