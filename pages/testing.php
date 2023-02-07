
<?php 

$page_title = "Homepage";
$level1 = "Home";
$level2 = "Testing and Reporting Results";


require_once('../shared/header.php')

?>

<!-- main from shared header -->

<!-- HTML specific to current page -->

<article>
    <h2>Testing and Reporting Results</h2>
    <section>
        <a class="title" href="book-pcr.php">Book a PCR Test</a> if you have <a href="symptoms.php">symptoms.</a>
    </section>

    <section>
        <a class="title" href="antigen.php">Get an Antigen test</a> to self-test at home if you do not have <a href="symptoms.php">symptoms</a>, but want to check if you are virus-free.
    </section>

    <section>
        <a class="title" href="report-positive.php">Report a positive result </a> from self-testing.
    </section>


</article>

<!-- shared footer -->
<?php
    require_once("../shared/footer.php");
?>





