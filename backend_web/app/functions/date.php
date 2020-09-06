<?php
function get_ymd_hi($date=null){ return $date ? date("Y-m-d H:i", strtotime($date)) : date("Y-m-d H:i");}
function get_dmy_hi($date=null){ return $date ? date("d-m-Y H:i", strtotime($date)) : date("d-m-Y H:i");}
function get_dmy_his($date=null){ return $date ? date("d-m-Y H:i:s", strtotime($date)) : date("d-m-Y H:i:s");}

function get_date($date=null,$format="d-m-Y H:i:s"){ return $date ? date($format, strtotime($date)) : date($format);}
