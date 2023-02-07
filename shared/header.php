<?php
  //code for page title and navigation path
  if(!isset($page_title)) { $page_title = 'No Title'; }

    //Associative array linking page titles to pages for navigation
    $name_path = array("Home"=>"index.php", "Cases"=>"cases.php", "Antigen Test"=>"antigen.php", "Book a PCR Test"=>"book-pcr.php", "Guidance and Prevention"=>"guidance.php", "PCR Test Booking Confirmed"=>"pcr-confirm.php", "Protect yourself and others"=>"protect.php", "Report a Positive Antigen Test"=>"report-positive.php", "How COVID-19 Spreads"=>"spread.php", "Testing and Reporting Results"=>"testing.php"); 
    //navigation path calculation (for navigation bar and location of script, images, styles)
    $cur_navigation = [$level1];
    if (isset($level2)) { $cur_navigation[] = $level2; }
    if (isset($level3)) { $cur_navigation[] = $level3; }
    $levels = sizeof($cur_navigation);
    switch ($levels) {
      case 1: $shared_lev = str_repeat('../', $levels-1);
      break;
      case 2: $shared_lev = str_repeat('../', $levels-1);
      break;
      case 3: $shared_lev = str_repeat('../', $levels-2);
      break;
    }

?>

<!-- HTML shared header -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- for legacy IE browsers -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- HTML5 control of viewport depending on the screen size -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Covid-19 Cyprus Response</title>
    <!-- style sheet relative path depending on current file -->
    <link rel="stylesheet" href="<?php echo $shared_lev.'styles/style.css'?>" />
    <!-- <link rel="stylesheet" href="<?php //echo $url_project.'/style.css'?>" /> -->
    <script src=<?php echo $shared_lev.'shared/javas.js'?>></script>
</head>

<body>
  <header>
    <img src=" <?php echo $shared_lev.'images/logo.png'?>" alt="logo" >
    <b><br>Hotline: 999111</b>  
  </header>
  
  <!-- static title -->
  <div id="header2">
    <h1>COVID-19 Cyprus Response</h1>
  </div>

  <!-- Navigation Bar -->
  <nav>
    <ul class="bc">
      <li>You are here:&nbsp&nbsp </li>
      <?php
      for ($i=0; $i<$levels; $i++) {
        // if this the last item in the array, it's the current page with no hyperlink
        if(!isset($cur_navigation[$i+1])) { 
          ?>
          <li><?php echo $cur_navigation[$i];?></li>
          <?php 
        } else {  
          $j = $cur_navigation[$i];
          $rel_path = '';
          switch ($i) {
            case 0: 
              $rel_path='../'; // for the homepage
              break;
            case 1 or 2:
              $rel_path='';
              break;
          }
          ?>
          <li><a class="bc" href=" <?php echo $rel_path.$name_path[$j] ?> "><?php echo $cur_navigation[$i]. '&nbsp&nbsp';?></a></li>
          <?php 
        }
      }  ?>
  </nav>
  
  <main>

  <!-- specific HTML for pages goes here -->



