<?php


function getFormatedDate($date)
{
    return Carbon\Carbon::parse($date)->setTimezone("Asia/Calcutta")->format("d-m-Y h:i A");
}