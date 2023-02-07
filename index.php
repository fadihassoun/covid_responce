<!-- PLEASE READ THE NOTE ON THE DATABASE CREDENTIALS -->
<?php 
//Storing the page title and navigation level in variables to use in common header and navigation bar
$page_title = "Home";
$level1 = "Home";

require_once('shared/header.php')
?>

<!-- HTML from shared header -->

<!-- HTML specific to current page -->

<article>
    <section>
        <h2>Cyprus response to the COVID-19 virus</h2> 
    </section>
    <section>
        <a class="title" href="pages/cases.php">Cases in Cyprus</a><br>
        See the latest information on COVID-19 cases and deaths in Cyprus.
    </section>

    <section>
        <a class="title" href="pages/guidance.php">Guidance and Prevention</a><br>
        Learn how COVID-19 is spread and how to protect yourself and others.
    </section>

    <section>
        <a class="title" href="pages/symptoms.php">Symptoms</a><br>
        Information about the symptoms of COVID-19.
    </section>

    <section>
        <a class="title" href="pages/testing.php">Testing and Reporting Results</a><br>
        Find out how to get tested and how to report a positive test result. <br><br><br>
    </section>

</article>

<!-- shared footer -->

<?php
require_once("shared/footer.php");
?>





