<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Configurations\WidgetRequest;
use App\Models\UserWidget;
use App\Models\Widget;
use App\Repository\Configuration\WidgetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WidgetController extends BaseController
{
    /**
     * @var WidgetRepository
     */
    private $widgetRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(WidgetRepository $widgetRepository)
    {
        parent::__construct();
        $this->widgetRepository = $widgetRepository;
    }


    public function index()
    {
        $widgets = $this->widgetRepository->all();
        return view('configurations.widgets.index', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(WidgetRequest $request)
    {
//        try {
//            $create = Widget::create($request->all());
//            if ($create) {
//                session()->flash('success', 'Widget successfully created');
//                return back();
//            } else {
//                session()->flash('error', 'Widget could not be created');
//                return back();
//            }
//        } catch (\Exception $e) {
//            $e->getMessage();
//            session()->flash('error', 'Exception : ' . $e);
//            return back();
//        }
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
//        try {
//            $id = (int)$id;
//            $edits = $this->widgetRepository->findById($id);
//            if (count($edits) > 0) {
//                $widgets = $this->widgetRepository->all();
//                return view('configurations.widgets.index', compact('edits', 'widgets'));
//            } else {
//                session()->flash('error', 'Id could not be obtained');
//                return back();
//            }
//
//        } catch (\Exception $e) {
//            $exception = $e->getMessage();
//            session()->flash('error', 'EXCEPTION :' . $exception);
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status($id)
    {
        $id = (int)$id;
        $widget = $this->widgetRepository->findById($id);
        if ($widget->widget_status == 'active') {
            $status = 'inactive';
            session()->flash('status', 'Widget Status Disabled!');
        } else {
            $status = 'active';
            session()->flash('status', 'Widget Status Enabled!');
        }
        $widget->widget_status = $status;
        $widget->save();
        return back();
    }

    public function userwidget()
    {
        $widgets = $this->widgetRepository->allActiveWidget();
        return view('configurations.widgets.user-widget.index', compact('widgets'));
    }

    public function userwidgetStatus($id)
    {
        $id = (int)$id;
        $user_widget = \App\Models\UserWidget::where('widget_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->first();
        if ($user_widget != null) {
            $data = UserWidget::find($user_widget->id);
            $data->delete();
            session()->flash('status', 'Widget Status Disabled!');
        } else {
            $data['user_id'] = Auth::user()->id;
            $data['widget_id'] = $id;
            UserWidget::insert($data);
            session()->flash('status', 'Widget Status Enabled!');
        }

        return back();
    }
}
