<?php

$db = 'cs284_spring24';
require_once "db-connect.php";

$q = "select * from rps_players";
$query = $pdo->prepare( $q );
$query->execute();
$allrows = $query->fetchAll();

print "<hr>\n";

foreach ($allrows as $row) {
   print "<p>\n";
   print_r($row);
   print "</p>\n\n";
}
