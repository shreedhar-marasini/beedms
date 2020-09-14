<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReminderRequest;
use App\Models\Reminder;
use App\Repository\CalendarRepository;
use App\Repository\ReminderRepository;
use App\Repository\UserRepository;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReminderController extends BaseController
{
    /**
     * @var ReminderRepository
     */
    private $reminderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;


    private $calendarRepository;
    /**
     * @var DocumentCategoryRepository
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(ReminderRepository $reminderRepository, CalendarRepository $calendarRepository, UserRepository $userRepository)
    {
        parent::__construct();
        $this->reminderRepository = $reminderRepository;
        $this->calendarRepository = $calendarRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $reminders = $this->reminderRepository->all($request);

        return view('reminders.index', compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reminders.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReminderRequest $request)
    {
        try {
            $userId = Auth::user()->name;
            $getUser = $this->reminderRepository->getUser();
            $getAllUser = $this->userRepository->getAllUsersId();
            $request['reminder_user_id'] = $getUser;
            $create = Reminder::create($request->all());

            if ($request->document_type == 'general') {
                $content = "<a href=" . url('http://localhost:8000/reminder/' . $create->id) . ">$create->reminder_content</a>";
                // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
            }
            else
                {
                if ($request->document_type == 'incoming')
                {
                    $id = $request->documentId;
                    $content = "<a href=" . url('http://localhost:8000/documents/incomingDocument/' . $id) . ">$create->reminder_content</a>";
                    // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
                }
                elseif ($request->document_type == 'digitized')
                {
                    $id = $request->documentId;
                    $content = "<a href=" . url('http://localhost:8000/documents/digitizedDocument/' . $id) . ">$create->reminder_content</a>";
                    // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
                }
                else
                {
                    $id = $request->documentId;
                    $content = "<a href=" . url('http://localhost:8000/documents/outgoingDocument/' . $id) . ">$create->reminder_content</a>";
                    // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
                }
            }

            if ($create) {
                session()->flash('success', 'Reminder successfully created');
                if ($create->reminder_to_email != null) {
                    Mail::send('emails.reminder', ['userId' => $userId, 'title' => $request->reminder_title, 'reminderDate' => $request->reminder_date, 'content' => $request->reminder_content], function ($m) use ($request) {
                        $m->to($request->reminder_to_email)->subject('General reminder created');
                        session()->flash('success', 'Reminder successfully created and sent email');
                    });
                }
                return redirect()->route('reminder.index')->withInput(['setData' => 'true']);
            } else {
                session()->flash('error', 'Reminder could not be created');
                return back();
            }
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $reminders = $this->reminderRepository->all($request);
        $rem = $this->reminderRepository->findById($id);
        return view('reminders.index', compact('rem', 'reminders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        try {
            $id = (int)$id;
            $edits = $this->reminderRepository->findById($id);
            if (count($edits) > 0) {
                $reminders = $this->reminderRepository->all($request);
                return view('reminders.edit', compact('edits', 'reminders'));
            } else {
                session()->flash('error', 'Id could not be obtained');
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
    public function update(ReminderRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $reminder = $this->reminderRepository->findById($id);
            if ($reminder) {
               $reminder->fill($request->all())->save();

                if ($request->document_type == 'general') {
                    $content = "<a href=" . url('http://localhost:8000/reminder/' . $reminder->id) . ">$reminder->reminder_content</a>";
                    // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
                }
                else
                {
                    if ($request->document_type == 'incoming')
                    {
                        $id = $request->documentId;
                        $content = "<a href=" . url('http://localhost:8000/documents/incomingDocument/' . $id) . ">$reminder->reminder_content</a>";
                        // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
                    }
                    elseif ($request->document_type == 'digitized')
                    {
                        $id = $request->documentId;
                        $content = "<a href=" . url('http://localhost:8000/documents/digitizedDocument/' . $id) . ">$reminder->reminder_content</a>";
                        // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
                    }
                    else
                    {
                        $id = $request->documentId;
                        $content = "<a href=" . url('http://localhost:8000/documents/outgoingDocument/' . $id) . ">$reminder->reminder_content</a>";
                        // $this->calendarRepository->store($request->reminder_title, $content, $request->reminder_date);
                    }
                }

                session()->flash('success', 'Reminder updated successfully');
                if ($request->document_id != null) {
                    if ($request->document_type == "incoming") {
                        return redirect('/documents/incomingDocument/' . $request->document_id);
                    } elseif ($request->document_type == "digitized") {
                        return redirect('/documents/digitizedDocument/' . $request->document_id);
                    } else {
                        return redirect('/documents/outgoingDocument/' . $request->document_id);
                    }

                }

                return redirect(route('reminder.index'));
            } else {

                session()->flash('error', 'No record with given id');
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

            if (Reminder::destroy($id)) {
                session()->flash('success', 'Reminder successfully deleted');
                return back();
            } else {
                session()->flash('error', 'Reminder could not be deleted');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }

    public function snoozeupdate(Request $request, $id)
    {
        $id = (int)$id;
        try {
            $reminder = $this->reminderRepository->findById($id);
            if ($reminder) {
                $reminder->fill($request->all())->save();
                session()->flash('success', 'Snooze created successfully');
                return back();
            } else {
                session()->flash('error', 'No record with given id');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }

    }

}
