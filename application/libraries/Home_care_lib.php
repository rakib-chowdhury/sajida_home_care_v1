<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_care_lib
{
    function decryptIt($q)
    {
        $cryptKey = 'Lf6Q5htqdgnSn0AABqlsSddj1QNu0fJs';
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return ($qDecoded);
    }

    function encryptIt($q)
    {
        $cryptKey = 'Lf6Q5htqdgnSn0AABqlsSddj1QNu0fJs';
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return ($qEncoded);
    }
    
    public function get_day_name($id)
    {
        $day_name = "";
        if ($id == 1) {
            $day_name = 'Monday';
        }
        if ($id == 2) {
            $day_name = 'Tuesday';
        }
        if ($id == 3) {
            $day_name = 'Wednesday';
        }
        if ($id == 4) {
            $day_name = 'Thursday';
        }
        if ($id == 5) {
            $day_name = 'Friday';
        }
        if ($id == 6) {
            $day_name = 'Saturday';
        }
        if ($id == 0) {
            $day_name = 'Sunday';
        }
        return $day_name;
    }
    public function get_date_day_from_millisecond($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');
        $temp = $millisecond_time/1000;
        return date('l, d-F-Y', $temp);
    }
    public function get_time_from_millisecond($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');
        $temp = $millisecond_time/1000;
        return date('H:i:s', $temp);
    }
    public function get_start_date($month, $year)
    {

        if($month == 01)
        {
            $month = 12;
            $year = $year - 1;
            $start_date = $year.'-'.$month.'-'.'26';
        }
        else
        {
            $month -= 1;
            $start_date = $year.'-'.$month.'-'.'26';
        }
        return $start_date;
    }

    public function get_end_date($month, $year)
    {
        $end_date = $year.'-'.$month.'-'.'25';
        return $end_date;
    }

    public function millisecond_to_time($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time/1000;
        $datetime = date('h:i A', $datetime);

        return $datetime;
    }

    public function millisecond_to_date($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time/1000;
        $datetime = date('Y-m-d', $datetime);

        return $datetime;
    }

    public function millisecond_to_full_time($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time/1000;
        $hours = floor($datetime/3600);
        $minutes = floor(($datetime/60)-($hours*60));
        $seconds = round($datetime-($hours*3600)-($minutes*60));
        $care_hours = $hours.':'.$minutes.':'.$seconds;

        return $care_hours;
    }

    public function millisecond_to_hour_min_time($millisecond_time)
    {
        //date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time/1000;
        $hours = floor($datetime/3600);
        $minutes = floor(($datetime/60)-($hours*60));
        $seconds = round($datetime-($hours*3600)-($minutes*60));
        $care_hours = $hours.':'.$minutes;

        return $care_hours;
    }
    public function format_date($date)
    {
        $explode = explode('/', $date);
        return $explode[2].'-'.$explode[0].'-'.$explode[1];
    }
    public function convert_date_time_to_millisecond($date, $time)
    {
        $concat = $date.' '.$time;
        return strtotime($concat)*1000;
    }
    public function convert_date_day_format($date)
    {
        $timestamp = strtotime($date);
        $formatted_date = date('l, d-F-Y', $timestamp);
        return $formatted_date;
    }
    public function millisecond_to_datetime($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time/1000;
        $datetime = date('F d, Y h:i A', $datetime);

        return $datetime;
    }

    public function get_id($joining_date)
    {
        $temp = explode('/', $joining_date);
        $id = $temp[1] . $temp[0] . substr($temp[2], 2, 3);
        return $id;
    }
}