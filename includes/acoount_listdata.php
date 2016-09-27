<?php
ini_set('memory_limit', '1024M');
require 'connect.php';
$sth = mysqli_query($con, "SELECT `Project_Activation_Date` FROM dmcdm1");
$rows2 = array();
while ($r1 = mysqli_fetch_assoc($sth)) {
    $rows2['data'][] = $r1['Project_Activation_Date'];
}
date_default_timezone_set('Europe/Berlin');
//define date and time
// $date = date("Y M d H:i:s");
foreach($rows2['data'] as $date) {
    $datetime = strtotime($date);
    $datetime = date ("j-F,Y",$datetime);
    $rows2['data'][] = $datetime;
}
$sth = mysqli_query($con, "SELECT `AS_Approved_Budget_Project_Margin_%` FROM dmcdm1");
$rows3 = array();
$rows3['name'] = 'AS_Approved_Budget_Project_Margin_%';
while ($r3 = mysqli_fetch_assoc($sth)) {
    $rows3['data'][] = ($r3['AS_Approved_Budget_Project_Margin_%'] *100);
}
$total = mysqli_query($con, "SELECT SUM(`AS_Approved_Budget_Project_Margin_%`) FROM dmcdm1;");
$total = mysqli_fetch_assoc($total);
function divide($n) {
    global $con;
    $count = mysqli_query($con, "SELECT `AS_Approved_Budget_Project_Margin_%` FROM dmcdm1;");
    $count = mysqli_num_rows($count);
    $factor = $count;
    return(($n / $factor)* 100);
}
//Average Margin
$average = array_map("divide", $total);
$rows4 = array();
$rows4['name'] = 'Average_Margin_%';
$i = 0;
$count = mysqli_query($con, "SELECT `AS_Approved_Budget_Project_Margin_%` FROM dmcdm1;");
$count = mysqli_num_rows($count);
while ($i < $count) {
    $rows4['data'][] = $average['SUM(`AS_Approved_Budget_Project_Margin_%`)'];
    $i++;
}
$result = array();
$rows2['data'] = array_reverse($rows2['data']);
$rows3['data'] = array_reverse($rows3['data']);
array_push($result,$rows2);
array_push($result,$rows3);
array_push($result,$rows4);

print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);
?>