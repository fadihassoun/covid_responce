<?php 

$page_title = "Protect yourself and others";
$level1 = "Home";
$level2 = "Guidance and Prevention";
$level3 = "Protect yourself and others";


require_once('../shared/header.php')

?>

<!-- main from shared header -->

<!-- HTML specific to current page -->

<article>
    <h2>Protect yourself and others</h2>
    
    <p>
    You can protect yourself and others around you by:
    </p>

    <ul>
        <li><a href="https://www.pio.gov.cy/coronavirus/eng/categories/vaccines-en">Getting Vaccinated</a> <em>(external link)</em></li><br>

        <li>Keeping a distance of 1 to 2m from people outside your household</li><br>
        <li>Washing your hands regularly especially after touching surfaces</li><br>
        <li>Wearing a face mask in crowded and indoor places</li><br>
        <li>Covering your coughs and sneezes</li><br>
        <li>Cleaning objects and surfaces regularly with household detergents</li><br>
        <li>Keeping indoor areas ventilated when meeting indoors</li><br>
        <li><a href="testing.php">Getting tested</a></li><br>
        <span id="isolate">
        <li><b>Self-isolating</b> if you have <a href="symptoms.php">symptoms</a> or if you tested positive: stay indoors (in a separate room if you live with others) and completely avoid contact with other people. Only go out if you need urgent medical help. Ask other people to go to the shop or pharmacy for you.</li><br></span>
    
    </ul>
    


    <p><br><br>
    <img id="img-body" src="../images/protect.jpg" alt="photo showing measures to protect yourself and others from COVID-19"   ondblclick="resize()" width="100%" maxwidth="760px">
    <span id="caption">Double click to enlarge / reset <br> <em>(Source: WHO)</em></span>
    </p>
    <br><br><br>

    <p>
    <iframe id=vid src="https://www.youtube.com/embed/7egUec9i8gc" title="YouTube video player" frameborder="0" allow="accelerometer" allowfullscreen></iframe>
    <span id="caption">Click to play<br> <em>(Source: WHO)</em></span>

    </p>


</article>

<!-- shared footer -->
<?php
    require_once("../shared/footer.php");
?>






