<?php
    require_once('../shared/dbconnect.php');



// Receiving AJAX variables and processing mysql retrieval for available days and times

//separating day request from time request
if(isset($_GET['q']) AND !isset($_GET['r'])) {
    $sel_cent = $_GET['q'];
    $query_days = "SELECT DISTINCT(Day) FROM ".$sel_cent." WHERE Availability = 'Y'";
    $result = mysqli_query($conn, $query_days);
    echo '<option id ="day" selected disabled>Select Day</option>';
    for ($i=0; $i<mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_assoc($result); 
        echo '<option id ="day">'.$row['Day'].'</option>';
    }
}
 
// available times 
if(isset($_GET['r'])) {
    $sel_day = $_GET['r'];
    $sel_cent = $_GET['q'];
    $query_times = "SELECT *  FROM ".$sel_cent." WHERE `Day` ="."'".$sel_day."'"." AND `Availability` = 'Y'";
    $result2 = mysqli_query($conn, $query_times);
    echo '<option id ="day" selected disabled>Select Time</option>';
    for ($i=0; $i<mysqli_num_rows($result2); $i++) {
        $row = mysqli_fetch_assoc($result2); 
        echo '<option id ="time">'.$row['Time'].'</option>';
    }
}

    // Release returned data
    // mysqli_free_result($result);
    // mysqli_free_result($result2);


    // Close database connection
    mysqli_close($conn);

?>