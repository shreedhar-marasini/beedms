<?php

namespace App\Repository\Calender;

use DB;

class CalenderRepository
{
    // nepali numbers
    private $N_N0;
    private $N_N1;
    private $N_N2;
    private $N_N3;
    private $N_N4;
    private $N_N5;
    private $N_N6;
    private $N_N7;
    private $N_N8;
    private $N_N9;

    // english numbers
    private $E_N0;
    private $E_N1;
    private $E_N2;
    private $E_N3;
    private $E_N4;
    private $E_N5;
    private $E_N6;
    private $E_N7;
    private $E_N8;
    private $E_N9;

    //nepali_month_names
    private $N_M1;
    private $N_M2;
    private $N_M3;
    private $N_M4;
    private $N_M5;
    private $N_M6;
    private $N_M7;
    private $N_M8;
    private $N_M9;
    private $N_M10;
    private $N_M11;
    private $N_M12;

    // nepali months in english

    private $E_M1;
    private $E_M2;
    private $E_M3;
    private $E_M4;
    private $E_M5;
    private $E_M6;
    private $E_M7;
    private $E_M8;
    private $E_M9;
    private $E_M10;
    private $E_M11;
    private $E_M12;

    public function __construct()
    {
        // nepali number initialization
        $this->N_N0 = "&#2406;";
        $this->N_N1 = "&#2407;";
        $this->N_N2 = "&#2408;";
        $this->N_N3 = "&#2409;";
        $this->N_N4 = "&#2410;";
        $this->N_N5 = "&#2411;";
        $this->N_N6 = "&#2412;";
        $this->N_N7 = "&#2413;";
        $this->N_N8 = "&#2414;";
        $this->N_N9 = "&#2415;";

        // english  number initialization
        $this->E_N0 = "0";
        $this->E_N1 = "1";
        $this->E_N2 = "2";
        $this->E_N3 = "3";
        $this->E_N4 = "4";
        $this->E_N5 = "5";
        $this->E_N6 = "6";
        $this->E_N7 = "7";
        $this->E_N8 = "8";
        $this->E_N9 = "9";

        // nepali months
        $this->N_M1 = "&#2357;&#2376;&#2358;&#2366;&#2326;";
        $this->N_M2 = "&#2332;&#2375;&#2359;&#2381;&#2336;";
        $this->N_M3 = "&#2309;&#2359;&#2366;&#2338;";
        $this->N_M4 = "&#2358;&#2381;&#2352;&#2366;&#2357;&#2339;";
        $this->N_M5 = "&#2349;&#2366;&#2342;&#2381;&#2352;";
        $this->N_M6 = "&#2310;&#2358;&#2381;&#2357;&#2367;&#2344;";
        $this->N_M7 = "&#2325;&#2366;&#2352;&#2381;&#2340;&#2367;&#2325;";
        $this->N_M8 = "&#2350;&#2306;&#2360;&#2367;&#2352;";
        $this->N_M9 = "&#2346;&#2369;&#2360;";
        $this->N_M10 = "&#2350;&#2366;&#2328;";
        $this->N_M11 = "&#2347;&#2366;&#2354;&#2381;&#2327;&#2369;&#2344;";
        $this->N_M12 = "चैत";

        // nepali months in english
        $this->E_M1 = "Baishak";
        $this->E_M2 = "Jestha";
        $this->E_M3 = "Ashar";
        $this->E_M4 = "Shrawan";
        $this->E_M5 = "Bhadra";
        $this->E_M6 = "Ashwin";
        $this->E_M7 = "Kartik";
        $this->E_M8 = "Mansir";
        $this->E_M9 = "Poush";
        $this->E_M10 = "Magh";
        $this->E_M11 = "Falgun";
        $this->E_M12 = "Chaitra";
    }

    function getNepaliNumerals($num, $lang = 'np')
    {
        $num = (string)$num;
        $arrNepNum = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
        $nepNum = '';
        if ($lang == 'np') {
            for ($i = 0; $i < strlen($num); $i++) {
                $nepNum .= (is_numeric($num[$i])) ? $arrNepNum[$num[$i]] : $num[$i];
            }
            return $nepNum;
        } else {
            return $num;
        }
    }

    private function nepaliFullDateUnicode($date_in_nepali, $format = 'y-m-d')
    {
        $nepali_month_names = array(
            $this->N_M1,
            $this->N_M2,
            $this->N_M3,
            $this->N_M4,
            $this->N_M5,
            $this->N_M6,
            $this->N_M7,
            $this->N_M8,
            $this->N_M9,
            $this->N_M10,
            $this->N_M11,
            $this->N_M12
        );

        $nepali_numbers = array(
            $this->N_N0,
            $this->N_N1,
            $this->N_N2,
            $this->N_N3,
            $this->N_N4,
            $this->N_N5,
            $this->N_N6,
            $this->N_N7,
            $this->N_N8,
            $this->N_N9
        );

        $date = explode("-", $date_in_nepali);
        $nep_year = preg_split('//', $date[0], -1, PREG_SPLIT_NO_EMPTY);
        $nep_month = $date[1];
        $nep_day = preg_split('//', $date[2], -1, PREG_SPLIT_NO_EMPTY);
        $n_year = '';

        foreach ($nep_year as $ny) {
            $n_year .= $nepali_numbers[$ny];
        }

        $n_month = $nepali_month_names[$nep_month - 1];
        $n_day = '';
        foreach ($nep_day as $nd) {
            $n_day .= $nepali_numbers[$nd];
        }

        $format = strtolower($format);

        if ($format == '' || $format == 'y m d' || $format == 'y-m-d') {
            return $n_year . " " . $n_month . " " . $n_day;
        } else if ($format == 'm-d' || $format == 'm d') {
            return $n_month . " " . $n_day;
        } else if ($format == 'y-m' || $format == 'y m') {
            return $n_year . " " . $n_month;
        } else if ($format == 'y') {
            return $n_year;
        }
    }

    private function nepaliFullDate($date_in_nepali, $format = 'y-m-d')
    {
        $nepali_month_names = array(
            $this->E_M1,
            $this->E_M2,
            $this->E_M3,
            $this->E_M4,
            $this->E_M5,
            $this->E_M6,
            $this->E_M7,
            $this->E_M8,
            $this->E_M9,
            $this->E_M10,
            $this->E_M11,
            $this->E_M12
        );

        $nepali_numbers = array(
            $this->E_N0,
            $this->E_N1,
            $this->E_N2,
            $this->E_N3,
            $this->E_N4,
            $this->E_N5,
            $this->E_N6,
            $this->E_N7,
            $this->E_N8,
            $this->E_N9
        );

        $date = explode("-", $date_in_nepali);
        $nep_year = preg_split('//', $date[0], -1, PREG_SPLIT_NO_EMPTY);
        $nep_month = $date[1];
        $nep_day = preg_split('//', $date[2], -1, PREG_SPLIT_NO_EMPTY);

        $n_year = '';
        foreach ($nep_year as $ny) {
            $n_year .= $nepali_numbers[$ny];
        }

        $n_month = $nepali_month_names[$nep_month - 1];
        $n_day = '';
        foreach ($nep_day as $nd) {
            $n_day .= $nepali_numbers[$nd];
        }
        //echo $n_year." ".$n_month." ".$n_day;
        $format = strtolower($format);

        if ($format == '' || $format == 'y m d' || $format == 'y-m-d') {
            return $n_year . " " . $n_month . " " . $n_day;
        } else if ($format == 'm-d' || $format == 'm d') {
            return $n_month . " " . $n_day;
        } else if ($format == 'y-m' || $format == 'y m') {
            return $n_year . " " . $n_month;
        } else if ($format == 'y') {
            return $n_year;
        }
    }

    private function nepaliShortDate($date_in_nepali, $format = 'y-m-d')
    {
        $date = explode("-", $date_in_nepali);
        $nep_year = $date[0];
        $nep_month = $date[1];
        $nep_day = $date[2];
        $format = strtolower($format);
        if ($format == '' || $format == 'y m d' || $format == 'y-m-d') {
            return $nep_year  . "-" . $nep_month  . "-" . $nep_day;
        } else if ($format == 'm-d' || $format == 'm d') {
            return $nep_month . " " . $nep_month;
        } else if ($format == 'y-m' || $format == 'y m') {
            return $nep_year . "-" . $nep_month;
        } else if ($format == 'y') {
            return $nep_year;
        }
    }

    private function getDateNepali($edate)
    {
        $dates = DB::select(
            DB::raw('SELECT
            nepali_year,
            month_code,
            eng_start_date,
            no_days
            FROM calenders
            WHERE eng_start_date <= ' . "'" . $edate . "'" . '
            AND eng_end_date >= ' . "'" . $edate . "'"
            )
        );

        if (count($dates) > 0) {
            foreach ($dates as $date) {
                //get offset from the start eng date
                $offset = @strtotime($edate) - @strtotime($date->eng_start_date);
                //convert into no. of days
                $offset = (int)($offset / (24 * 60 * 60));
                $nepdate = $date->nepali_year . "-" . $date->month_code . "-" . ($offset + 1);
            }
            return $nepdate;
        } else {
            return false;
        }
    }

    public function getDateEnglish($nDate)
    {
        $date = explode("-", $nDate);

        $year = $date[0];
        $months = $date[1];
        $days = $date[2] - 1; //  -1 is for date adjustment ;

        $dates = DB::select(
            DB::raw('SELECT
            DATE_ADD(eng_start_date,INTERVAL ' . $days . ' DAY) AS eng_date
            FROM calenders
            WHERE nepali_year = ' . "'" . $year . "'" . '
            AND month_code = ' . "'" . $months . "'"
            )
        );
    
        if (count($dates) > 0) {
            foreach ($dates as $date) {
                $nepDate = $date->eng_date;
                return $nepDate;
            }
        } else {
            return false;
        }
    }

    function getNpLastDay($npYear,$npMonth)
    {
        $dates = DB::select(
            DB::raw("SELECT no_days FROM calenders WHERE nepali_year = $npYear and month_code = $npMonth"));
        if (count($dates) > 0) {
            foreach ($dates as $date) {
                return $date->no_days;
            }
        } else {
            return false;
        }
    }

    public  function getNepaliDate($engDate, $type = false)
    {
         $nepDate = $this->getDateNepali($engDate);
        if ($nepDate) {
            return  $date = $this->nepaliShortDate($nepDate, $format = 'y-m-d');
            if ($type) {

                if ($type === "array") {
                    $date['full_unicode_date'] = $this->nepaliFullDateUnicode($nepDate, $format = 'y-m-d');
                    $date['full_date'] = $this->nepaliFullDate($nepDate, $format = 'y-m-d');
                    $date['short_unicode_date'] = $this->getNepaliNumerals($this->nepaliShortDate($nepDate, $format = 'y-m-d'));
                    $date['short_date'] = $this->nepaliShortDate($nepDate, $format = 'y-m-d');
                    return $date;
                } else if ($type === "fud") {
                    $date = $this->nepaliFullDateUnicode($nepDate, $format = 'y-m-d');
                } else if ($type === "fd") {
                    $date = $this->nepaliFullDate($nepDate, $format = 'y-m-d');
                } else if ($type === "sud") {
                    $date = $this->getNepaliNumerals($this->nepaliShortDate($nepDate, $format = 'y-m-d'));
                } else if ($type === "sd") {
                    $date = $this->nepaliShortDate($nepDate, $format = 'y-m-d');
                }
            }
            return $date;
        } else {
            return false;
        }
    }

    public function getEnglishDate($npDate)
    {
       
        $date = $this->getDateEnglish($npDate);
      
        return $date;
    }

    public function getFormattedDate($date = '', $format = 'Y-m-d')
    {
        date_default_timezone_set('Asia/Katmandu');
        return $date;
    }

    public static function todayMonth()
    {
        $today =date('Y-m-d');
        $date =   DB::table('calenders')
            ->where('eng_start_date','<=',$today)
            ->where('eng_end_date','>=',$today)
            ->first();
        if($date)
        {
            $months =   DB::table('months')
                ->where('id','=',$date->month_code)
                ->first();
            return $months->name.'-'.$date->nepali_year;
        }
    }

    public static function currentYear()
    {
        $today =date('Y-m-d');
        $date =   DB::table('calenders')
            ->where('eng_start_date','<=',$today)
            ->where('eng_end_date','>=',$today)
            ->first();
        if($date)
        {
            return $date->nepali_year;
        }
        return false;
    }
}