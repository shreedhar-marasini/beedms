<?php
/**
 * Created by PhpStorm.
 * User: sushil
 * Date: 9/5/17
 * Time: 4:12 PM
 */

namespace App\Repository;
use App\Models\MasterSetting;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;



class CalendarRepository
{

    /**
     * CalendarRepository constructor.
     */
    public function __construct()
    {
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setAuthConfig('ServiceAccount.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
//        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array('CURLOPT_SSL_VERIFYPEER' => false)));
//        $client->setHttpClient($guzzleClient);
        $this->client = $client;

    }


    public function store($summary,$description,$dateTime)
    {
     
            $calender=MasterSetting::where('key_name','=','_GOOGLE_CALENDER_ID_')->first();
     
            $service = new Google_Service_Calendar($this->client);
      
            $calendarId = $calender->key_value;
           
            $event = new Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'location' => '',
            'description' => $description,
            'start' => array(
                'dateTime' => $dateTime,
                'timeZone' => 'GMT+5:45',
            ),
          
            'end' => array(
                'dateTime' => $dateTime,
                'timeZone' => 'GMT+5:45',
            ),
//            'recurrence' => array(
//                'RRULE:FREQ=DAILY;COUNT=2'
//            ),
//            'attendees' => array(
//                array('email' => 'lpage@example.com'),
//                array('email' => 'sbrin@example.com'),
//            ),
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
            ),
        ));

        try{
            $results = $service->events->insert($calendarId, $event);

        } catch (Google_ServiceException $e) {
            syslog(LOG_ERR, $e->getMessage());
        }
            if (!$results) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'message' => 'Event Created']);
        }

}