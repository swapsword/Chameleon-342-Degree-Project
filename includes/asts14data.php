<?php
require 'connect.php';

$sth = mysqli_query($con, "SELECT Accounts FROM accounts.account");
$rows1 = array();
$rows1['name'] = 'Accounts';
while($r1 = mysqli_fetch_assoc($sth)) {
    $rows1['data'][] = $r1['Accounts'];
}

$sth = mysqli_query($con, "SELECT FY14_Product FROM accounts.account");
$rows2 = array();
$rows2['name'] = 'Product';
while($r2 = mysqli_fetch_assoc($sth)) {
    $rows2['data'][] = $r2['FY14_Product'];
}

$sth = mysqli_query($con, "SELECT FY14_AS FROM accounts.account");
$rows3 = array();
$rows3['name'] = 'AS';
while($r3 = mysqli_fetch_assoc($sth)) {
    $rows3['data'][] = $r3['FY14_AS'];
}

$sth = mysqli_query($con, "SELECT FY14_TSS FROM accounts.account");
$rows4 = array();
$rows4['name'] = 'TS';
while($r4 = mysqli_fetch_assoc($sth)) {
    $rows4['data'][] = $r4['FY14_TSS'];
}

$result = array();
array_push($result,$rows1);
array_push($result,$rows4);
array_push($result,$rows3);
array_push($result,$rows2);


print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);
?>