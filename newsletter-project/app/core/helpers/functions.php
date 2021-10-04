<?php session_start();

function checkIsUserLoggedIn() {
    if (isset($_SESSION['admin_id'])) {
        return true;
    }
    return false;
}

function prettyArrayDisplay($param) {
    echo "<pre>";
    print_r($param);
    echo "</pre>";
}

function old($param) {
    if ($param !== null) {
        echo $param;
    } else {
        echo '';
    }
}

function prettyDate($param) {
    return date('d.m.Y h:m:s', strtotime($param));

}
function timeago($param) {
    $timestamp = strtotime($param);	
    
    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60","60","24","30","12","10");

    $currentTime = time();
    if($currentTime >= $timestamp) {
         $diff     = time()- $timestamp;
         for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
         $diff = $diff / $length[$i];
         }

         $diff = round($diff);
         return $diff . " " . $strTime[$i] . "(s) ago ";
    }
 }
function limitChars($param) {
    if (strlen($param) > 150) {
        echo substr($param, 0, 130  ) . '...';
    }
    else {
        echo $param;
    }
        
}
function sendMail($email) {
    $message = "Dear subscriber, this might be interesting to you. Keep folowing out blog. Cheers!";
    mail($email,"New content is added", $message);
    //echo "SUCCES!";
    
}

function checkEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
      }
      return true;

}
