<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/3/17
 * Time: 11:06 AM
 */

namespace App\Repository\Configuration;


use App\Models\DocumentCategory;
use App\Models\Template;

class TemplateRepository
{
    private $template;

    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function all()
    {
        $templates = $this->template
            ->join('dms_document_categories', 'dms_document_categories.id', '=', 'dms_templates.document_category_id')
            ->select('dms_document_categories.*', 'dms_templates.*', 'dms_templates.id as id')
            ->orderBy('template_name','asc')
            ->get();
        return $templates;
    }

    public function getTemplateCategoryList($selectedId = 0)
    {
//        $documentCategories = DocumentCategory::where('parent_id', '=', 0)->get();
//
//        $list = '';
//        foreach ($documentCategories as $documentCategory) {
//            $select = ($selectedId == $documentCategory->id) ? 'selected' : null;
//            $list .= "<option value = " . $documentCategory->id . " style='font-weight:bolder;' " . $select . "disabled>" . $documentCategory->category_name . "</option>";
//            $levelOne = $this->template
//                ->join('dms_document_categories','dms_templates.document_category_id','=','dms_document_categories.id')
//                ->select('dms_templates.template_name', 'dms_templates.id')
//                ->where('dms_document_categories.parent_id', '=', $documentCategory->id)
//                ->get();
//
//            foreach ($levelOne as $one) {
//                $levelOneSelect = ($selectedId == $one->id) ? 'selected' : null;
//                $list .= "<option value=" . $one->id . " " . $levelOneSelect . "> &emsp;" . $one->template_name . "</option>";
//            }
//        }
//
//        echo $list;


        $documentCategories = DocumentCategory::where('parent_id', '=', 0)->get();


        $list = '';
        foreach ($documentCategories as $documentCategory) {
            $select = ($selectedId == $documentCategory->id) ? 'selected' : null;
            $list .= "<option value = " . $documentCategory->id . " style='font-weight:bolder;' " . $select . "disabled>" . $documentCategory->category_name . "</option>";
            $levelOne =DocumentCategory::where('parent_id', '=', $documentCategory->id)
                ->select('category_name', 'id')
                ->orderBy('category_name','asc')
                ->get();

            foreach ($levelOne as $one) {
                $levelOneSelect = ($selectedId == $one->id) ? 'selected' : null;
//                $list .= "<option value=" . $one->id . " " . $levelOneSelect . " disabled> &emsp;" . $one->category_name . "</option>";
                $levelTwo = $this->template
                    ->join('dms_document_categories','dms_templates.document_category_id','=','dms_document_categories.id')
                    ->select('dms_templates.template_name', 'dms_templates.id')
                    ->where('dms_templates.document_category_id', '=', $one->id)
                    ->get();

                foreach ($levelTwo as $two) {
                    $levelTwoSelect = ($selectedId == $two->id) ? 'selected' : null;
                    $list .= "<option value=" . $two->id . " " . $levelTwoSelect . "> &emsp;&emsp;" . $two->template_name . "</option>";
                }
            }
        }

        echo $list;
    }



}