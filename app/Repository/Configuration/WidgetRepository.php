<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/6/17
 * Time: 5:14 PM
 */

namespace App\Repository\Configuration;


use App\Models\Widget;

class WidgetRepository
{

    /**
     * @var Widget
     */
    private $widget;

    public function __construct(Widget $widget)
    {
        $this->widget = $widget;
    }

    public function all()
    {
        $widgets = $this->widget->orderBy('widget_name', 'Asc')->get();
        return $widgets;
    }

    public function allActiveWidget()
    {
        $widgets = $this->widget
            ->where('widget_status', '=', 'active')
            ->orderBy('widget_name', 'Asc')
            ->get();
        return $widgets;
    }

    public function findById($id)
    {
        $widgets = $this->widget->findOrFail($id);
        return $widgets;
    }
}