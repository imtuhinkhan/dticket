<?php
use Carbon\Carbon;

if (! function_exists('ticketStatus')) {
    function ticketStatus($id)
    {
        if($id==1){
            $status='Open';
        }elseif($id==2){
            $status='Re Open';
        }elseif($id==3){
            $status='Close Resolved';
        }elseif($id==4){
            $status='Close Unesolved';
        }

        return $status;
    }
}

if (! function_exists('timeConvert')) {
    function timeConvert($time)
    {
        return Carbon::now()->toDateTimeString();
    }
}

