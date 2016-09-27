<?php
/**
 * Created by PhpStorm.
 * User: swapnpat
 * Date: 20-05-2016
 * Time: 14:41
 */
include 'includes/connect.php';
echo '<h1>Query Performance for basic system architecture</h1>';
echo '<br>';
echo '<h2>Test conditions:</h2>';
echo '<h4>1. Same database and table is used for both of the system architecture.</h4>';
echo '<h4>2. Same query is used for both of the system architecture.</h4>';
echo '<h4>3. Query used is "SELECT * FROM main.test".</h4>';
echo '<br>';

echo '<h2>In milliseconds: </h2>';

for ($x = 0; $x <= 10; $x++) {
    $sql = 'SELECT * FROM opdata.avdatatest';
    $msc = microtime(true);
    mysqli_query($con,$sql);
    $msc = microtime(true)-$msc;
    echo ($msc * 1000) . ' ms'; // in milliseconds
    echo '<br>';
}

?>