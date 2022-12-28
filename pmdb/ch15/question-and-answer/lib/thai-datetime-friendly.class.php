<?php
class ThaiDateTimeFriendly {
      function of($year_month_date_str) {
            date_default_timezone_set('Asia/Bangkok');
            $ts = strtotime($year_month_date_str);
            $now = time();
            if(!$ts || $ts > $now) { 
                  return ''; 
            }

            $diff = $now - $ts;

            $second = 1;
            $minute = 60 * $second;
            $hour = 60 * $minute;
            $day = 24 * $hour;
            $yesterday = 48 * $hour;
            $month = 30 * $day;
            $year = 365 * $day;
            
            $dt_friendly = '';

            if($diff >= $year) {
                $dt_friendly = round($diff/$year) . ' ปี ที่แล้ว';
            }	
            else if($diff >= $month) {
                $dt_friendly = round($diff/$month) . ' เดือน ที่แล้ว';
            }	
            else if($diff > $yesterday) {
                $dt_friendly = intval($diff/$day) . ' วัน ที่แล้ว';
            }
            else if($diff <= $yesterday && $diff >= $day) {
                $dt_friendly =  ' เมื่อวานนี้';
            }
            else if($diff >= $hour) {
                $dt_friendly = intval($diff/$hour) . ' ชั่วโมง ที่แล้ว';
            }
            else if($diff >= $minute) {
                $dt_friendly = intval($diff/$minute) . ' นาที ที่แล้ว';
            }	
            else if($diff >= 5*$second) {
                $dt_friendly = intval($diff/$second) . ' วินาที ที่แล้ว';
            }
            else {
                $dt_friendly = 'เมื่อสักครู่';
            }          
            return $dt_friendly;        
      }
}
?>

