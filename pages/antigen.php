
<?php 

$page_title = "Antigen Test";
$level1 = "Home";
$level2 = "Testing and Reporting Results";
$level3 = "Antigen Test";


require_once('../shared/header.php')

?>
<!-- main from shared header -->

<!-- HTML specific to current page -->

<article>
    <h2>Do an Antigen Test</h2>
    
    <p>
    Antigen tests are available for free at all health centres where a representative can assist you to conduct them. You can also refer to the infographic below for guidance.
    </p>
    
    <p><br><br>
    <img id="img-body" src="../images/antigen.png" alt="photo showing how to conduct an antigen test"   ondblclick="resize()" width="80%">
    <span id="caption">Double click to enlarge / reset <br> <em>(Source: NSW)</em></span>

    </p>


</article>

<!-- shared footer -->
<?php
    require_once("../shared/footer.php");
?>






