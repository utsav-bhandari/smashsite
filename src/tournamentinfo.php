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

$tournament_key = $_POST['key'];
$player_id = $_POST['p_id'];

// print_r(get_set_data($tournament_key, $player_id));
$sets = get_set_data($tournament_key, $player_id);

if (count($sets) == 0) {
    exit_nicely("<h1>No information on this tournament!<h1>\n");
}

$tournament_name = $_POST['t_name'];
$player_tag = get_tag($player_id)[0]['tag'];
print("<h1>$player_tag</h1>");
print("<h1>$tournament_name</h1>");

$cache_map = [];
foreach ($sets as $key => $row) {
    // $opponent_tag = get_tag($opponenent_id)[0]['tag'];

    // print_r($row);
    $opponenent_id = ($player_id == $row['p1_id']) ? $row['p2_id'] : $row['p1_id'];
    $opponent_tag = "";
    if ($cache_map[$opponenent_id] == null) {
        $opponent_tag = get_tag($opponenent_id)[0]['tag'];
        $cache_map[$opponenent_id] = $opponent_tag;
    } else {
        $opponent_tag = $cache_map[$opponenent_id];
    }
    // $opponent_tag = get_tag($opponenent_id);

    $game_info = json_decode(str_replace("'", "\"", $row['game_data']));    
    // print_r($game_info);
    foreach ($game_info as $game_num => $game) {
        // print_r($game);
        $game = (array)$game;

        $winner = ($game['winner_id'] == $player_id) ? $player_tag : $opponent_tag;
        $loser = ($game['loser_id'] == $player_id) ? $player_tag : $opponent_tag;
        $winner_score = $game['winner_score'];
        $loser_score = $game['loser_score'];
        $winner_char = ucfirst(str_replace("ultimate/", "", $game['winner_char']));
        $loser_char = ucfirst(str_replace("ultimate/", "", $game['loser_char']));
        $stage = $game['stage'];

        if ($winner_score != "" && $loser_score != "") {
            print("$winner won the match $winner_score - $loser_score.\n");
        } elseif ($winner_score != "" && $loser_score == "") {
            print("$winner won the match by scoring $winner_score wins.\n");
        } elseif ($winner_score == "" && $loser_score != "") {
            print("$loser lost the match with $loser_score wins.\n");
        }
        if ($winner_char != "" && $loser_char != "") {
            print("$winner won by playing $winner_char against $loser's $loser_char.\n");
        } elseif ($winner_char != "" && $loser_char == "") {
            print("$winner won by playing $winner_char against $loser.\n");
        } elseif ($winner_char == "" && $loser_char != "") {
            print("$loser lost against $winner while playing $loser_char.\n");
        }
        if ($stage != "") {
            print("It took place in $stage.\n");
        }
        print("</p>");
    }    

}


?>


</body>
</html>