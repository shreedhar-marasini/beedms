<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReminderDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Reminder To Users';

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

        $reminders = DB::table('dms_reminders')
            ->where('reminder_date', Carbon::now()->toDateString())
            ->get();

        foreach ($reminders as $reminder) {
            $creator =  DB::table('users')->where('id',$reminder->reminder_user_id)->first();
                Mail::send('emails.reminder', ['userId' => $creator->name, 'title' => $reminder->reminder_title, 'reminderDate' => $reminder->reminder_date, 'content' => $reminder->reminder_content], function ($m) use ($reminder,$creator) {
                    $m->to($reminder->reminder_to_email)->subject('Document Reminder Alert!');
                    $m->to($creator->email)->subject('Document Reminder Alert!');
            });
        }
    }
}
