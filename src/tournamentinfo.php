<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament data</title>
</head>
<body>
    
<?php
include "../includes/cleaning-functions.php";
include "../../smashsite_queries/tournamentinfo_query.php";
include "../includes/exit-nicely.php";

$tournament_key = $_GET['key'];
$player_id = $_GET['p_id'];

print_r(get_set_data($tournament_key, $player_id));
?>


</body>
</html>