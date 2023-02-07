<?php
// Current page variables
$page_title = "Book a PCR Test";
$level1 = "Home";
$level2 = "Testing and Reporting Results";
$level3 = "Book a PCR Test";

// requiring files
require_once('../shared/dbconnect.php');
require_once('../shared/header.php');
require_once('../shared/global.php');

/* Server-side form validation and sanitization
    In case HTML5 and Javascript are not available; can be checked by removing html "required" and commenting JS */
$city = $center = $day = $time = $fname = $lname = $ident = $email = $bdate = $tel = $sp_need = "";
$error=FALSE;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST)) {
        $error = "Missing data <br>";
    }

    if (empty($_POST['city'])) {
        $error .= "City is not selected <br>";
    } else {
        $city = sanit_mysql($conn,$_POST['city']); 
    }

    if (empty($_POST['center'])) {
        $error .= "Center is not selected <br>";
    } else {
        $center = sanit_mysql($conn,$_POST['center']); 
    }

    if (empty($_POST['day'])) {
        $error .= "Testing Day is not selected <br>";
    } else {
        $day = sanit_mysql($conn,$_POST['day']); 
    }
    
    if (empty($_POST['time'])) {
        $error .= "Testing Time is not selected <br>";
    } else {
        $time = sanit_mysql($conn,$_POST['time']); 
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

    if (empty($_POST['ident'])) {
        $error .= "Identity Number field is missing <br>";
    } else {
        $ident = sanit_mysql($conn,$_POST['ident']); 
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

    $sp_need = isset($_POST['sp_need'])?'Y':'N';
    
    //if anything is missing, $error will be displayed in <span id="error"> tag
    //otherwise:
    if (!$error) {
        //delete previously booked appointment by same user (same last name and ID) to avoid multiple bookings as much as possible
        $query_delp = "UPDATE ".$center. " 
        SET Availability ='Y',
        First_Name = '' ,
        Last_Name = '' ,
        ID = '' ,
        Email = '' ,
        Birth_date = '' ,
        Phone = '' ,
        Special_Needs = '' 
        WHERE Last_Name='".$lname."' AND ID='".$ident."'"; 
        $result_delp = mysqli_query($conn, $query_delp);

        //Insert booking details into mysql database
        $query_book = "UPDATE ".$center." SET 
        Availability ='N',
        First_Name = '".$fname."' ,
        Last_Name = '".$lname."' ,
        ID = '".$ident."' ,
        Email = '".$email."' ,
        Birth_date = '".$bdate."' ,
        Phone = '".$tel."' ,
        Special_Needs = '".$sp_need."' 
        WHERE Day = '".$day."' AND Time = '".$time."'";
        $result = mysqli_query($conn, $query_book);
        // check if query succeeded
        if (!$result) {echo ("Database query failed, please contact us on s21004286@glyndwr.ac.uk");}
        
        // retrieve reference number from database (Center+Ref) 
        $query_ref = "SELECT * FROM ".$center." WHERE Day = '".$day."' AND Time = '".$time."'";
        echo '<br>';
        $result_ref = mysqli_query($conn, $query_ref);
        // check if query succeeded
        if (!$result_ref) {echo ("Database query failed, please contact us on s21004286@glyndwr.ac.uk");}

        $row= mysqli_fetch_assoc($result_ref);
        $ref=$row['Ref'];

        if ($result) { // if the query is successful the following message will be displayed
        ?>

            <article>

            <p><b>Successfully booked</b> <br><br>
            Your appointment for a PCR test in the <?php echo $center ?> testing center on <?php echo $day  ?> at <?php echo $time ?> is confirmed. <br><br> 
            Your ref number is <b><?php echo substr($center,0,3).$ref ?></b>. 
            Please write down this number or print the current page. <br><br>
            
            A representative will call you one day before your appointment for further confirmation. <br><br>

            Note that this overrides any previous booking you have done in this center.<br><br>

            On your testing day, please bring with you your ID, the reference number, and be there <u>15min</u> before the scheduled time. In case you require special assistance, a center employee will assist you. <br><br>

                        
            Meanwhile, please check the advice on the <a href="protect.php">Guidance and Prevention</a> page.</p>

            </article>

            <?php
        } else { //else : error connecting to mysql database
            ?> 
            <p>
            <span id="error">Unsuccessful. <br>
            Please hit back, fill any missing information, and try again.
            </p></span>
            <?php
        }

        require_once('../shared/footer.php');
        // Release returned data
        mysqli_free_result($result_ref);


        // Close database connection
        mysqli_close($conn);

        exit(); // to skip the display of the form again 
    } 

}  
        ?>


<!-- HTML specific to current page -->

<article>

    <h2>Book a PCR Test</h2>
    <br>
   
    <p>Select a centre, pick an available date, fill in the form below and click submit. Upon submission, you will get a confirmation message on your screen with a reference number displayed. <br><br>

    <form name="pcrform" action="#" method="post" onsubmit="validate_js()" > <!-- post to same file-->
        <!-- error message will be displayed if information is missing after submit -->
        <span id ="error" > <?php if ($error) {echo "<b>Could not process request</b><br>".$error;} ?> </span>
        
        <label for="city">Select your city </label><select id="city" name="city" onchange="city_func()" required >
        <!-- city_func function will retrieve the available centers for "center" options -->
            <option value ="N" selected disabled> Select City</option>
            <option value="Limassol">Limassol</option>
            <option value="Nicosia">Nicosia</option>
            </select><br>


        <label for="center">Select the testing center </label><select name ="center" id="center" onchange="center_func(this.value)" required>
        <!-- center_func function will retrieve the available date for "day" options -->
            <option value ="N" selected disabled> Select City First</option>
            </select><br>

        <label for="day">Select from available dates </label><select name="day" style="width:220px" id="dates" onchange="day_func(this.value)" required>
        <!-- day_func function will retrieve available times for a specific day -->
            <option value ="N" selected disabled> Select Center First</option> </select><br>


        <label for="time">Select from available Times </label><select name="time" id="time" required> 
            <option value ="N" selected disabled> Select Dates First</option> </select><br>       

        <label for="fname" style="margin-top: 30px;">First Name </label><input type="text" id="fname" name="fname" pattern="[A-Za-z]+" title="Letters Only" required maxlength="25"  value="<?php echo $fname;?>"><br> <!-- echo to keep already entered information -->

        <label for="lname">Last Name </label><input type="text" id="lname" name="lname" pattern="[A-Za-z]+" title="Letters Only" required maxlength="25" value="<?php echo $lname;?>"><br>

        <label for="ident">ID or Passport Number </label><input type="text" id="ident" name="ident"pattern="[0-9]+" title="Numbers only" required maxlength="12" value="<?php echo $ident;?>"><br>

        <label for="email">Email </label><input type="email" id="email" name="email" required maxlength="75" placeholder="email@example.com" value="<?php echo $email;?>"><br><br>

        <fieldset>
            <legend>Birth Date: </legend>
            <!-- chosen for better appearance than the default date input -->
            <label for="byear">&nbsp&nbsp Year</label><select id="byear" name="byear" required>
                <option value ="" selected disabled hidden >Select a Year</option>
                <?php 
                $min_year  = 1916; //include oldest person in Cyprus
                $max_year = date('Y')-2; // children below 2 need to visit a doctor
                for ($i = $max_year; $i >= $min_year; $i--) {
                    echo '<option >'.$i.' </option>';
                }
                ?>
            </select><br>

            <label for="bmonth">&nbsp&nbsp Month</label><select id="bmonth" name="bmonth" required>
                <option value ="" selected disabled hidden>Select Month</option>
                    <?php
                    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    for ($i=0; $i<12; $i++) { 
                        echo '<option value='.$i.'>'.$months[$i].'</option>';
                    }
                    ?>
            </select><br>

            <label for="bday">&nbsp&nbsp Day</label><select id="bday" name="bday" required>
                <option value ="" selected disabled hidden>Select Day</option>
                    <?php
                    for ($i = 1; $i <= 31; $i++) { 
                    echo '<option >'.$i.'</option>';
                    }
                ?>
            </select><br>
        </fieldset><br>

        <label for="tel">Mobile Number  </label><input type="text" id="tel" name="tel" pattern="[0-9]+" title="Numbers only" placeholder="8 digits" required maxlength="8" value=<?php echo $tel ?>><br>

        <label id="cont"><input name="sp_need" type="checkbox"> I require special assistance</label><br><br>

        <input type="submit" value="Submit"> <br>

        <input type="reset" value="Clear entered data">

    </form>
    <br><span id="caption"><em>Note: Children under 2 years old need to see a doctor first</em></span>
    <br>

</article>

<!-- shared footer -->
<?php
    require_once("../shared/footer.php");


?>
