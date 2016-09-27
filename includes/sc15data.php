<?php
/*This file is use for generating the json data for plotting the highchart graph*/

require 'connect.php';

/*Selecting column and storing it into array*/
$sth = mysqli_query($con, "SELECT Accounts FROM accounts.coefficient");
$rows1 = array();
$rows1['name'] = 'Accounts';
while($r1 = mysqli_fetch_assoc($sth)) {
    $rows1['data'][] = $r1['Accounts'];
}

/*Selecting column and storing it into array*/
$sth = mysqli_query($con, "SELECT FY15_PvsS FROM accounts.coefficient");
$rows2 = array();
$rows2['name'] = 'Service Coefficient';
while($r2 = mysqli_fetch_assoc($sth)) {
    $rows2['data'][] = $r2['FY15_PvsS'];
}

/*Selecting column and storing it into array*/
$sth = mysqli_query($con, "SELECT FY15_PvsTS FROM accounts.coefficient");
$rows3 = array();
$rows3['name'] = 'TS Coefficient';
while($r3 = mysqli_fetch_assoc($sth)) {
    $rows3['data'][] = $r3['FY15_PvsTS'];
}

/*Selecting column and storing it into array*/
$sth = mysqli_query($con, "SELECT FY15_PvsAS FROM accounts.coefficient");
$rows4 = array();
$rows4['name'] = 'AS Coefficient';
while($r4 = mysqli_fetch_assoc($sth)) {
    $rows4['data'][] = $r4['FY15_PvsAS'];
}

/*Making one array from more array, required for generating json data*/
$result = array();
array_push($result,$rows1);
array_push($result,$rows2);
array_push($result,$rows3);
array_push($result,$rows4);


print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);
?>