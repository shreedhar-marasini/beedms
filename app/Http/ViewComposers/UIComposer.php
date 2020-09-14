<?php
/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 9/6/17
 * Time: 3:01 PM
 */

namespace App\Http\ViewComposers;


use App\Models\MasterSetting;
use Illuminate\View\View;

class UIComposer
{
    /**
     * @var MasterSetting
     */
    private $masterSetting;

    function __construct(MasterSetting $masterSetting)
    {
        $this->masterSetting = $masterSetting;
    }

    public function compose(View $view)
    {
        $uiComponent = $this->masterSetting
            ->get();
        $view->with('uiComponent', $uiComponent);
    }
}