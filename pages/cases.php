<?php
$page_title = 'Cases';
$level1 = "Home";
$level2 = "Cases";

require_once('../shared/dbconnect.php');
require_once('../shared/header.php');

//retrieve Cases rows from Mysql table
$query_cases = "SELECT * FROM cases ORDER BY Ref DESC";
$result = mysqli_query($conn, $query_cases);

//check if query succeeded
if (!$result) {
    exit("Database query failed.");
}
?>

<!-- main from shared header -->

<!-- HTML specific to current page -->

<article>
  <h2> Cases</h2>
  <p>Last Updated On: 
    <?php 
    $row = mysqli_fetch_assoc($result);
    echo $row['dateRep']
    ?> 
  </p>
  
  <p>
    The table below shows the last 14 days of the COVID-19 confirmed cases and deaths in Cyprus as well as the total numbers to date:
  </p>
  <table class="list">
    <tr>
      <th>Date</th>
      <th>Daily Cases</th>
      <th>Daily Deaths</th>
      <th>Total Cases</th>
      <th>Total Deaths</th>
    </tr>
  
    <?php
    mysqli_data_seek($result,0); // reset mysql pointer
    // for loop to display last 14 days data
    for ($i=0; $i<14; $i++) {
      $row = mysqli_fetch_assoc($result);
      ?>

      <tr>
        <td><?php echo htmlspecialchars($row['dateRep']); ?></td> <!-- sanitize data from table-->
        <td><?php echo htmlspecialchars($row['cases']); ?></td>
        <td><?php echo htmlspecialchars($row['deaths']); ?></td>
        <td><?php echo htmlspecialchars($row['totalCases']); ?></td>
        <td><?php echo htmlspecialchars($row['totalDeaths']); ?></td>
        </tr>
      
    <?php 
    } ?>
    
  </table>

<?php
// Release returned data
mysqli_free_result($result);

// Close database connection
mysqli_close($conn);
?>

<br><span id=caption><em>The above data is only for the Republic of Cyprus</em></span>
</article>

<!-- shared footer -->
<?php
    require_once("../shared/footer.php");
?>



