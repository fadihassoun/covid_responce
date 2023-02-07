<?php

//prevent mysql injection (sanitization)
function sanit_mysql($conn, $str) {
    $str = strip_tags($str);
    $str = htmlentities($str);
    return mysqli_real_escape_string($conn, $str);
}

?>

