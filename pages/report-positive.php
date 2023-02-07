<?php
// Current page variables
$page_title = 'Report a Positive Antigen Test';
$level1 = "Home";
$level2 = "Testing and Reporting Results";
$level3 = "Report a Positive Antigen Test";

// requiring files
require_once('../shared/header.php');
require_once('../shared/dbconnect.php');
require_once('../shared/global.php');

/* Server-side form validation and sanitization
    In case HTML5 and Javascript are not available; can be checked by removing html "required" and commenting JS */
$fname = $lname = $email = $bdate = $tel = "";
$error=FALSE;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST)) {
        $error = "Missing data <br>";
    }
    if (empty($_POST['fname'])) {
        $error .= "First Name field is missing <br>";
    } else {
        $fname = sanit_mysql($conn,$_POST['fname']); 
    }
    if (empty($_POST['lname'])) {
        $error .= "Last Name field is missing <br>";
    } else {
        $lname = sanit_mysql($conn,$_POST['lname']); 

    }
    if (empty($_POST['email'])) {
        $error .= "Email field is missing <br>";
    } else {
        $email = sanit_mysql($conn,$_POST['email']);
    }
    if (empty($_POST['byear']) || (empty($_POST['bmonth'])) || (empty($_POST['bday'])) ) {
        $error .= "Birth Date is not selected <br>";
    } else {
        $bdate = sanit_mysql($conn,$_POST['byear']).'-'.sanit_mysql($conn,$_POST['bmonth']).'-'.sanit_mysql($conn,$_POST['bday']); 
    }    
    if (empty($_POST['tel'])) {
        $error .= "Mobile Number field is missing <br>";
    } else {
        $tel = sanit_mysql($conn,$_POST['tel']); 
    }
    //if anything is missing, $error will be displayed in <span id="error"> tag
    //otherwise:
    if (!$error) {
        //Create table in mysql if it is not already created
        $query_tbl = "CREATE TABLE IF NOT EXISTS antigen
        (First_Name VARCHAR(35) NOT NULL , Last_Name VARCHAR(35) NOT NULL , Email VARCHAR(35) NOT NULL , Birth_Date VARCHAR(20) NOT NULL , Tel INT NOT NULL ) ENGINE = InnoDB;"; 
        
        //delete previously reported record by same user to avoid multiple inserts of same user
        $query_del = "DELETE FROM antigen WHERE First_Name='".$fname."' AND Last_Name='".$lname."' AND Email='".$email."' AND Birth_Date='".$bdate."' AND Tel='".$tel."'";
        
        //Insert test details into mysql database
        $query_rp = "INSERT INTO antigen (First_Name, Last_Name, Email, Birth_Date, Tel) 
        VALUES ('".$fname."', '".$lname."', '".$email. "', '".$bdate."', '".$tel."')";

        $result_tbl = mysqli_query($conn, $query_tbl);
        if (!$result_tbl) { echo ("Table query failed, please contact us on s21004286@glyndwr.ac.uk");}

        $result_del = mysqli_query($conn, $query_del);

        $result_rp = mysqli_query($conn, $query_rp);
        // if the report query is not successful:
        if (!$result_rp) { echo ("Insert query failed, please contact us on s21004286@glyndwr.ac.uk");} else {
            ?>

            <article>
            
            <h2>Your result was successfully registered</h2>
            <p> Please follow the guidance on how to limit the spread of COVID-19, and check you symptoms regularly. If you develop serious <a class="title" href="symptoms.php#serious">symptoms</a> call 999111</p>

            Meanwhile, please check the advice on the <a href="protect.php">Guidance and Prevention</a> page.</p>

            </article>

            <?php
                require_once('../shared/footer.php');


                // Close database connection
                mysqli_close($conn);

                exit();// to skip the display of the form again 
        };
    }
}
            ?>



<!-- HTML specific to current page -->

<article>

    <h2>Report a Positive Antigen Test Result</h2><br>


    <p>Please fill in the form below and click submit, then follow the instructions. <b>If you develop serious <a class="title" href="symptoms.php">symptoms</a> call  999111</b></p><br>

    <form name="anti_form" action="" method="post" onsubmit="return validateAntigen_js()">
        <!-- error message will be displayed if information is missing after submit -->
        <span id ="error"> <?php if ($error) {echo "<b>Could not process request</b><br>".$error;} ?> </span><br>

        <label for="fname">First Name </label><input type="text" id="fname" name="fname" pattern="[A-Za-z]+" title="Letters Only" required maxlength="25" value="<?php echo $fname;?>"><br> <!-- echo to keep already entered information -->

        <label for="lname">Last Name </label><input type="text" id="lname" name="lname" pattern="[A-Za-z]+" title="Letters Only" required maxlength="25" value="<?php echo $lname;?>"><br>

        <label for="email">Email </label><input type="email" id="email" name="email" required maxlength="75" placeholder="email@example.com" value="<?php echo $email;?>"><br><br>

        <fieldset>
            <legend>Birth Date: </legend>
            <!-- chosen for better appearance than the default date input -->
            <label for="byear">&nbsp&nbsp Year</label> 
            <select id="byear" name="byear">
                <option value ="" selected disabled hidden > Select a Year</option>
                <?php 
                $min_year  = 1916; //include oldest person in Cyprus
                $max_year = date('Y')-2; // children below 2 need to visit a doctor
                for ($i = $max_year; $i >= $min_year; $i--) {
                    echo '<option >'.$i.' </option>';
                }
                ?>
            </select><br>
        
            <label for="bmonth">&nbsp&nbsp Month</label>
            <select id="bmonth" name="bmonth">
                <option value ="" selected disabled hidden> Select Month</option>
                    <?php
                    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    for ($i=0; $i<12; $i++) { 
                        echo '<option value='.$i.'>'.$months[$i].'</option>';
                    }
                    ?>
            </select><br>

            <label for="bday">&nbsp&nbsp Day</label>
            <select id="bday" name="bday">
                <option value ="" selected disabled hidden> Select Day</option>
                    <?php
                    for ($i = 1; $i <= 31; $i++) { 
                        echo '<option >'.$i.'</option>';
                    }
                ?>
            </select><br>
        </fieldset><br>
    

        <label for="tel">Mobile Number  </label><input type="text" id="tel" name="tel" pattern="[0-9]+" title="Numbers only" placeholder="8 digits" required maxlength="8" value=<?php echo $tel ?>><br>

        <input type="submit" value="Submit" ><br>

        <input type="reset" value="Clear entered data" >
    </form> 

</article>

<!-- shared footer -->
<?php
    require_once("../shared/footer.php");
?>









