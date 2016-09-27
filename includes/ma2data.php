<?php
session_start();
$search_term = $_SESSION['ma'];
$search_term1 = $_SESSION['ma-account'];
$search_term2 = $_SESSION['ma-from'];
$search_term3 = $_SESSION['ma-to'];
//echo $search_term;
//echo $search_term1;
require 'connect.php';
if($search_term == null || $search_term1 == null){
    $sth = mysqli_query($con, "SELECT `Project_Activation_Date` FROM ma WHERE (MA_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
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
    $sth = mysqli_query($con, "SELECT `Actual_Revenue` FROM ma WHERE (MA_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
    $rows3 = array();
    $rows3['name'] = 'Actual_Revenue';
    while ($r3 = mysqli_fetch_assoc($sth)) {
        $rows3['data'][] = $r3['Actual_Revenue'];
    }
    $sth = mysqli_query($con, "SELECT `AS_Approved_Revenue_Budget` FROM ma WHERE (MA_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
    $rows4 = array();
    $rows4['name'] = 'AS_Approved_Revenue_Budget';
    while ($r4 = mysqli_fetch_assoc($sth)) {
        $rows4['data'][] = $r4['AS_Approved_Revenue_Budget'];
    }
    $result = array();
    $rows2['data'] = array_reverse($rows2['data']);
    $rows3['data'] = array_reverse($rows3['data']);
    $rows4['data'] = array_reverse($rows4['data']);
    array_push($result, $rows2);
    array_push($result, $rows3);
    array_push($result, $rows4);

    print json_encode($result, JSON_NUMERIC_CHECK);
}
if($search_term != null && $search_term1 != null){
    $sth = mysqli_query($con, "SELECT `Project_Activation_Date` FROM ma WHERE (MA_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
    $rows2 = array();
    while ($r1 = mysqli_fetch_assoc($sth)) {
        $rows2['data'][] = $r1['Project_Activation_Date'];
    }
    date_default_timezone_set('Europe/Berlin');
//define date and time
    $date = date("Y M d H:i:s");
    foreach ($rows2['data'] as $date) {
        $datetime = strtotime($date);
        $datetime = date("j-F,Y", $datetime);
        $rows2['data'][] = $datetime;
    }
    $sth = mysqli_query($con, "SELECT `Actual_Revenue` FROM ma WHERE (MA_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
    $rows3 = array();
    $rows3['name'] = 'Actual_Revenue';
    while ($r3 = mysqli_fetch_assoc($sth)) {
        $rows3['data'][] = $r3['Actual_Revenue'];
    }
    $sth = mysqli_query($con, "SELECT `AS_Approved_Revenue_Budget` FROM ma WHERE (MA_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
    $rows4 = array();
    $rows4['name'] = 'AS_Approved_Revenue_Budget';
    while ($r4 = mysqli_fetch_assoc($sth)) {
        $rows4['data'][] = $r4['AS_Approved_Revenue_Budget'];
    }
    $result = array();
    $rows2['data'] = array_reverse($rows2['data']);
    $rows3['data'] = array_reverse($rows3['data']);
    $rows4['data'] = array_reverse($rows4['data']);
    array_push($result, $rows2);
    array_push($result, $rows3);
    array_push($result, $rows4);

    print json_encode($result, JSON_NUMERIC_CHECK);
}
mysqli_close($con);
?>