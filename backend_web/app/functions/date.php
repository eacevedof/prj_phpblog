<?php
function get_ymd_hi($date){ return date("Y-m-d H:i", strtotime($date)) ;}
function get_dmy_hi($date){ return date("d-m-Y H:i", strtotime($date)) ;}
