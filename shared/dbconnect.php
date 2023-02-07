<?php
//make a connection to the database 
//credentials: localhost 'admin' password:'mysql' database:fhcovid_db 

//connect with admin user
$conn = mysqli_connect('localhost', 'admin', 'mysql' ); //database left blank to create it if it doesn't exist
if (mysqli_connect_errno()) {
    echo " <br> Sorry for the inconvenience, the page could not connect to the database, error: " . mysqli_connect_error().
    "<br>Please refresh the page and try again; if the problem persists, please <a href=\"mailto:s21004286@mail.glyndwr.ac.uk\">email the administrator ";
    exit();
};

// create database and tables if not imported
$query_db = "CREATE DATABASE IF NOT EXISTS fhcovid_db"; 
$result_db = mysqli_query($conn, $query_db);

$query_dbu = "USE fhcovid_db"; 
$result_dbu = mysqli_query($conn, $query_dbu);

//create Cases table if it doesn't exist
$query_tblCases = "CREATE TABLE IF NOT EXISTS cases (
    Ref INT AUTO_INCREMENT,
    dateRep DATE, 
    day INT, 
    month INT, 
    year INT,
    cases INT, 
    deaths INT, 
    totalCases INT, 
    totalDeaths INT,
    PRIMARY KEY (REF)
    )
    ENGINE = InnoDB  DEFAULT CHARSET=utf8mb3;";
$result_tblCases = mysqli_query($conn, $query_tblCases);
if (!$result_tblCases) { echo ("Table query failed, please contact us on s21004286@glyndwr.ac.uk");}

$query_insertCases = "INSERT INTO cases    
    (`Ref`, `dateRep`, `day`, `month`, `year`, `cases`, `deaths`, `totalCases`, `totalDeaths`) VALUES
    ('772', '2022-04-19', '19', '4', '2022', '1131', '4', '470370', '1001'),
    ('773', '2022-04-20', '20', '4', '2022', '1137', '1', '471507', '1002'),
    ('774', '2022-04-21', '21', '4', '2022', '1588', '2', '473095', '1004'),
    ('775', '2022-04-22', '22', '4', '2022', '1313', '3', '474408', '1007'),
    ('776', '2022-04-23', '23', '4', '2022', '2029', '1', '476437', '1008'),
    ('777', '2022-04-24', '24', '4', '2022', '1523', '2', '477960', '1010'),
    ('778', '2022-04-25', '25', '4', '2022', '1273', '3', '479233', '1013'),
    ('779', '2022-04-26', '26', '4', '2022', '1279', '2', '480512', '1015'),
    ('780', '2022-04-27', '27', '4', '2022', '1167', '1', '481679', '1016'),
    ('781', '2022-04-28', '28', '4', '2022', '1131', '2', '482810', '1018'),
    ('782', '2022-04-29', '29', '4', '2022', '1137', '3', '483947', '1021'),
    ('783', '2022-04-30', '30', '4', '2022', '1588', '1', '485535', '1022'),
    ('784', '2022-05-01', '1', '5', '2022', '1313', '2', '486848', '1024'),
    ('785', '2022-05-02', '2', '5', '2022', '1029', '3', '487877', '1027'),
    ('786', '2022-05-03', '3', '5', '2022', '1523', '2', '489400', '1029');";
$result_insertCases = mysqli_query($conn, $query_insertCases);

// similarly to the testing center tables

$query_tblCent1 = "CREATE TABLE IF NOT EXISTS `neapolis` (
    `Ref` int NOT NULL AUTO_INCREMENT,
    `Day` varchar(23) DEFAULT NULL,
    `Time` varchar(8) DEFAULT NULL,
    `Availability` varchar(12) DEFAULT NULL,
    `First_Name` varchar(25) DEFAULT NULL,
    `Last_Name` varchar(25) DEFAULT NULL,
    `ID` varchar(14) DEFAULT NULL,
    `Email` varchar(75) DEFAULT NULL,
    `Birth_date` varchar(10) DEFAULT NULL,
    `Phone` varchar(10) DEFAULT NULL,
    `Special_Needs` varchar(4) DEFAULT NULL,
    PRIMARY KEY (`Ref`),
    KEY `Availability` (`Availability`)
  ) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb3;";
$result_tblCent1 = mysqli_query($conn, $query_tblCent1);


$query_insertCent1 = "INSERT INTO `neapolis` (`Ref`, `Day`, `Time`, `Availability`, `First_Name`, `Last_Name`, `ID`, `Email`, `Birth_date`, `Phone`, `Special_Needs`) VALUES
    (2, 'Tuesday, May 3, 2022', '9:00 AM', 'Y', '', '', '', '', '', '', ''),
    (3, 'Tuesday, May 3, 2022', '9:30 AM', 'N', 'Grace', 'Holmes', '67022', 'g.holmes@randatmail.com', '24-04-86', '986642313', ''),
    (4, 'Tuesday, May 3, 2022', '10:00 AM', 'N', 'Steven', 'Montgomery', '507923', 's.montgomery@randatmail.com', '30-06-70', '475193061', ''),
    (5, 'Tuesday, May 3, 2022', '10:30 AM', 'Y', '', '', '', '', '', '', ''),
    (6, 'Tuesday, May 3, 2022', '11:00 AM', 'Y', '', '', '', '', '', '', ''),
    (7, 'Tuesday, May 3, 2022', '11:30 AM', 'N', 'Michelle', 'Turner', '197960', 'm.turner@randatmail.com', '20-10-47', '443176584', ''),
    (8, 'Wednesday, May 4, 2022', '9:00 AM', 'N', 'Robert', 'Walker', '554806', 'r.walker@randatmail.com', '08-03-38', '864785893', 'Y'),
    (9, 'Wednesday, May 4, 2022', '9:30 AM', 'Y', '', '', '', '', '', '', ''),
    (10, 'Wednesday, May 4, 2022', '10:00 AM', 'N', 'James', 'Grant', '490171', 'j.grant@randatmail.com', '28-01-77', '191431060', ''),
    (11, 'Wednesday, May 4, 2022', '10:30 AM', 'N', 'Violet', 'Wright', '472907', 'v.wright@randatmail.com', '08-01-33', '532472015', 'Y'),
    (12, 'Wednesday, May 4, 2022', '11:00 AM', 'Y', '', '', '', '', '', '', ''),
    (13, 'Wednesday, May 4, 2022', '11:30 AM', 'Y', '', '', '', '', '', '', '');";
$result_insertCent1 = mysqli_query($conn, $query_insertCent1);



$query_tblCent2 = "CREATE TABLE IF NOT EXISTS `ypsonas` (
    `Ref` int NOT NULL AUTO_INCREMENT,
    `Day` varchar(23) DEFAULT NULL,
    `Time` varchar(8) DEFAULT NULL,
    `Availability` varchar(12) DEFAULT NULL,
    `First_Name` varchar(25) DEFAULT NULL,
    `Last_Name` varchar(25) DEFAULT NULL,
    `ID` varchar(14) DEFAULT NULL,
    `Email` varchar(75) DEFAULT NULL,
    `Birth_date` varchar(10) DEFAULT NULL,
    `Phone` varchar(10) DEFAULT NULL,
    `Special_Needs` varchar(4) DEFAULT NULL,
    PRIMARY KEY (`Ref`),
    KEY `Availability` (`Availability`)
  ) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb3;";
$result_tblCent2 = mysqli_query($conn, $query_tblCent2);


$query_insertCent2 = "INSERT INTO `ypsonas` (`Ref`, `Day`, `Time`, `Availability`, `First_Name`, `Last_Name`, `ID`, `Email`, `Birth_date`, `Phone`, `Special_Needs`) VALUES
    (2, 'Tuesday, May 3, 2022', '9:00 AM', 'Y', '', '', '', '', '', '', ''),
    (3, 'Tuesday, May 3, 2022', '9:30 AM', 'N', 'Garry', 'Armstrong', '931742', 'g.armstrong@randatmail.com', '27-03-10', '1713834', ''),
    (4, 'Tuesday, May 3, 2022', '10:00 AM', 'Y', '', '', '', '', '', '', ''),
    (5, 'Tuesday, May 3, 2022', '10:30 AM', 'N', 'Grace', 'Holmes', '67022', 'g.holmes@randatmail.com', '24-04-86', '986642313', ''),
    (6, 'Tuesday, May 3, 2022', '11:00 AM', 'N', 'Steven', 'Montgomery', '507923', 's.montgomery@randatmail.com', '30-06-70', '475193061', ''),
    (7, 'Tuesday, May 3, 2022', '11:30 AM', 'Y', '', '', '', '', '', '', ''),
    (8, 'Wednesday, May 4, 2022', '9:00 AM', 'Y', '', '', '', '', '', '', ''),
    (9, 'Wednesday, May 4, 2022', '9:30 AM', 'N', 'Michelle', 'Turner', '197960', 'm.turner@randatmail.com', '20-10-47', '443176584', ''),
    (10, 'Wednesday, May 4, 2022', '10:00 AM', 'N', 'Robert', 'Walker', '554806', 'r.walker@randatmail.com', '08-03-38', '864785893', 'Y'),
    (11, 'Wednesday, May 4, 2022', '10:30 AM', 'Y', '', '', '', '', '', '', ''),
    (12, 'Wednesday, May 4, 2022', '11:00 AM', 'N', 'James', 'Grant', '490171', 'j.grant@randatmail.com', '28-01-77', '191431060', ''),
    (13, 'Wednesday, May 4, 2022', '11:30 AM', 'N', 'Violet', 'Wright', '472907', 'v.wright@randatmail.com', '08-01-33', '532472015', 'Y');";
$result_insertCent2 = mysqli_query($conn, $query_insertCent2);


$query_tblCent3 = "CREATE TABLE IF NOT EXISTS `strovolos` (
    `Ref` int NOT NULL AUTO_INCREMENT,
    `Day` varchar(23) DEFAULT NULL,
    `Time` varchar(8) DEFAULT NULL,
    `Availability` varchar(12) DEFAULT NULL,
    `First_Name` varchar(25) DEFAULT NULL,
    `Last_Name` varchar(25) DEFAULT NULL,
    `ID` varchar(14) DEFAULT NULL,
    `Email` varchar(75) DEFAULT NULL,
    `Birth_date` varchar(10) DEFAULT NULL,
    `Phone` varchar(10) DEFAULT NULL,
    `Special_Needs` varchar(4) DEFAULT NULL,
    PRIMARY KEY (`Ref`),
    KEY `Availability` (`Availability`)
    ) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb3;";
$result_tblCent3 = mysqli_query($conn, $query_tblCent3);

$query_insertCent3 = "INSERT INTO `strovolos` (`Ref`, `Day`, `Time`, `Availability`, `First_Name`, `Last_Name`, `ID`, `Email`, `Birth_date`, `Phone`, `Special_Needs`) VALUES
    (2, 'Tuesday, May 3, 2022', '9:00 AM', 'N', 'Kevin', 'Johnson', '28693', 'k.johnson@randatmail.com', '08-06-77', '97985789', ''),
    (3, 'Tuesday, May 3, 2022', '9:30 AM', 'Y', '', '', '', '', '', '', ''),
    (4, 'Tuesday, May 3, 2022', '10:00 AM', 'N', 'Sienna', 'Crawford', '24912', 's.crawford@randatmail.com', '31-07-95', '784905717', 'Y'),
    (5, 'Tuesday, May 3, 2022', '10:30 AM', 'N', 'Kate', 'Gray', '443205', 'k.gray@randatmail.com', '15-12-08', '303007712', ''),
    (6, 'Tuesday, May 3, 2022', '11:00 AM', 'Y', '', '', '', '', '', '', ''),
    (7, 'Tuesday, May 3, 2022', '11:30 AM', 'N', 'Garry', 'Armstrong', '931742', 'g.armstrong@randatmail.com', '27-03-10', '1713834', ''),
    (8, 'Wednesday, May 4, 2022', '9:00 AM', 'Y', '', '', '', '', '', '', ''),
    (9, 'Wednesday, May 4, 2022', '9:30 AM', 'N', 'Grace', 'Holmes', '67022', 'g.holmes@randatmail.com', '24-04-86', '986642313', ''),
    (10, 'Wednesday, May 4, 2022', '10:00 AM', 'N', 'Steven', 'Montgomery', '507923', 's.montgomery@randatmail.com', '30-06-70', '475193061', ''),
    (11, 'Wednesday, May 4, 2022', '10:30 AM', 'Y', '', '', '', '', '', '', ''),
    (12, 'Wednesday, May 4, 2022', '11:00 AM', 'Y', '', '', '', '', '', '', ''),
    (13, 'Wednesday, May 4, 2022', '11:30 AM', 'N', 'Michelle', 'Turner', '197960', 'm.turner@randatmail.com', '20-10-47', '443176584', '');";
$result_insertCent3 = mysqli_query($conn, $query_insertCent3);


$query_tblCent4 = "CREATE TABLE IF NOT EXISTS `trachonas` (
    `Ref` int NOT NULL AUTO_INCREMENT,
    `Day` varchar(23) DEFAULT NULL,
    `Time` varchar(8) DEFAULT NULL,
    `Availability` varchar(12) DEFAULT NULL,
    `First_Name` varchar(25) DEFAULT NULL,
    `Last_Name` varchar(25) DEFAULT NULL,
    `ID` varchar(14) DEFAULT NULL,
    `Email` varchar(75) DEFAULT NULL,
    `Birth_date` varchar(10) DEFAULT NULL,
    `Phone` varchar(10) DEFAULT NULL,
    `Special_Needs` varchar(4) DEFAULT NULL,
    PRIMARY KEY (`Ref`),
    KEY `Availability` (`Availability`)
  ) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb3;";
$result_tblCent4 = mysqli_query($conn, $query_tblCent4);

$query_insertCent4 = "INSERT INTO `trachonas` (`Ref`, `Day`, `Time`, `Availability`, `First_Name`, `Last_Name`, `ID`, `Email`, `Birth_date`, `Phone`, `Special_Needs`) VALUES
    (2, 'Tuesday, May 3, 2022', '9:00 AM', 'N', 'Sienna', 'Crawford', '24912', 's.crawford@randatmail.com', '31-07-95', '784905717', 'Y'),
    (3, 'Tuesday, May 3, 2022', '9:30 AM', 'N', 'Kate', 'Gray', '443205', 'k.gray@randatmail.com', '15-12-08', '303007712', ''),
    (4, 'Tuesday, May 3, 2022', '10:00 AM', 'Y', '', '', '', '', '', '', ''),
    (5, 'Tuesday, May 3, 2022', '10:30 AM', 'N', 'Garry', 'Armstrong', '931742', 'g.armstrong@randatmail.com', '27-03-10', '1713834', ''),
    (6, 'Tuesday, May 3, 2022', '11:00 AM', 'Y', '', '', '', '', '', '', ''),
    (7, 'Tuesday, May 3, 2022', '11:30 AM', 'N', 'Grace', 'Holmes', '67022', 'g.holmes@randatmail.com', '24-04-86', '986642313', ''),
    (8, 'Wednesday, May 4, 2022', '9:00 AM', 'N', 'Steven', 'Montgomery', '507923', 's.montgomery@randatmail.com', '30-06-70', '475193061', ''),
    (9, 'Wednesday, May 4, 2022', '9:30 AM', 'Y', '', '', '', '', '', '', ''),
    (10, 'Wednesday, May 4, 2022', '10:00 AM', 'Y', '', '', '', '', '', '', ''),
    (11, 'Wednesday, May 4, 2022', '10:30 AM', 'N', 'Michelle', 'Turner', '197960', 'm.turner@randatmail.com', '20-10-47', '443176584', ''),
    (12, 'Wednesday, May 4, 2022', '11:00 AM', 'N', 'Robert', 'Walker', '554806', 'r.walker@randatmail.com', '08-03-38', '864785893', 'Y'),
    (13, 'Wednesday, May 4, 2022', '11:30 AM', 'Y', '', '', '', '', '', '', '');";
$result_insertCent4 = mysqli_query($conn, $query_insertCent4);


?>
