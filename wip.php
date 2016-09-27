<h1>Work In Progress</h1><br><hr>
<h2>Section coming soon..........</h2><br>
<?php
$con = mysqli_connect("localhost","root","mysql","drupal");

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


$sth = mysqli_query($con, "SELECT testcol FROM drupal.test");
$rows1 = array();
$rows1['name'] = 'testcol';
while($r1 = mysqli_fetch_assoc($sth)) {
    $rows1['data'][] = $r1['testcol'];
}

$result = array();
array_push($result,$rows1);

print_r($result);
//print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);
?>