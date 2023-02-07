<?php 

$page_title = "COVID-19 Symptoms";
$level1 = "Home";
$level2 = "Symptoms";


require_once('../shared/header.php')

?>

<!-- main from shared header -->


<!-- HTML specific to current page -->

<article>
    <h2>COVID-19 Symptoms</h2>
                    
    <span>On average they might start showing 4 days after infection.</span>

    <section><h3>Common Symptoms:</h3>

    <ul>
        <li>Fever</li>
        <li>Cough</li>
        <li>Fatigue</li>
    </ul>

    </section>

    <section><h3>Less Common:</h3>

    <ul>
        <li>Soar throat</li>
        <li>Aches</li>
        <li>Diarrhea</li>
    </ul>

    </section>

    <section>
        If you have these symptoms, you need to <a href="protect.php#isolate">self-isolate</a> and <a href="testing.php">get tested</a>.
    </section>

    <section id="serious"><h3>Serious Symptoms</h3>

    <ul>
        <li>Difficulty Breathing</li>
        <li>Chest Pain</li>
        <li>Confusion</li>
    </ul>

    </section>
    <br><span style="text-align:left" id=caption><em>(Source:WHO)</em></span>


    <section>
        <br><br><b>If you develop serious symptoms call 999111</b>.
    </section>
</article>

<!-- shared footer -->
<?php
    require_once("../shared/footer.php");
?>







