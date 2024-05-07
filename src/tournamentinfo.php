<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tournamentinfo-styles.css">
    <link rel="stylesheet" href="playerinfo-styles.css">
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
?>
<div id='playerinfo'>
<?php
print("<h1>$player_tag</h1>");
print("<p style='font-size: 1.5em;'>$tournament_name</p>");
?>
</div>

<?php
function cool_bar($player_name, $score_1, $player_won, $body, $score_2 = 0,) {
    $status_emoji = '👑';
    $lose_style = 'background-color: red;';
    if (!$player_won) $status_emoji = '💀';
    else $lose_style = '';

    if ($body != "") {
        $player_name = "<u>" . $player_name ."</u>";
    }

    return <<<BEGIN
    <div class='bb'>
    <details class='info'>
        <summary style='overflow: hidden;'>
            <div class='winner' style='z-index: 1; overflow: hidden; $lose_style'>
            $status_emoji 
            $player_name
            </div>
            <div class='winner' style='z-index: 0; width: 10px; height: auto; transform: translateX(-11px) skewX(-35deg); $lose_style'>
            </div>
            <div class='winner-score'>
                $score_1
                —
                $score_2
            </div>
        </summary>
        $body
    </details>
    </div class='bb'>
    BEGIN;
}
?>

<?php
$cache_map = [];
foreach ($sets as $row) {
    $positionality = [];
    $opponent_id = "";
    if ($player_id == $row['p1_id']) {
        $opponent_id = $row['p2_id']; 
        $positionality[$opponent_id] = 'p2_score';
        $positionality[$player_id] = 'p1_score';
        $positionality['p1_score'] = $opponent_id;
        $positionality['p2_score'] = $player_id;
    } else {
        $opponent_id = $row['p1_id'];
        $positionality[$opponent_id] = 'p1_score';
        $positionality[$player_id] = 'p2_score';
        $positionality['p1_score'] = $player_id;
        $positionality['p2_score'] = $opponent_id;
    }

    $opponent_tag = "";
    if ($cache_map[$opponent_id] == null) {
        $opponent_tag = get_tag($opponent_id)[0]['tag'];
        $cache_map[$opponent_id] = $opponent_tag;
    } else {
        $opponent_tag = $cache_map[$opponent_id];
    }

    $player_won = $row['winner_id'] == $player_id;

    $winner = "";
    $loser_id = "";
    if ($row['winner_id'] == $player_id) {
        $winner = $player_tag;
        $loser_id = $positionality[$positionality[$row['winner_id']]];
    } else {
        $winner = $opponent_tag;
        $loser_id = $positionality[$positionality[$row['winner_id']]];
    } 

    $body = "";

    $game_info = json_decode(str_replace("'", "\"", $row['game_data']));    
    foreach ($game_info as $game_num => $game) {
        $game = (array)$game;

        $winner = ($game['winner_id'] == $player_id) ? $player_tag : $opponent_tag;
        $loser = ($game['loser_id'] == $player_id) ? $player_tag : $opponent_tag;
        $winner_score = $game['winner_score'];
        $loser_score = $game['loser_score'];
        $winner_char = ucfirst(str_replace("ultimate/", "", $game['winner_char']));
        $loser_char = ucfirst(str_replace("ultimate/", "", $game['loser_char']));
        $stage = $game['stage'];

        $inner_body = "";
        if ($winner_score == "") $winner_score = "?";
        if ($winner_char != "" && $loser_char != "") {
            $inner_body = $inner_body . ("$winner won by playing $winner_char against $loser's $loser_char.\n");
        } elseif ($winner_char != "" && $loser_char == "") {
            $inner_body = $inner_body . ("$winner won by playing $winner_char against $loser.\n");
        } elseif ($winner_char == "" && $loser_char != "") {
            $inner_body = $inner_body . ("$loser lost against $winner while playing $loser_char.\n");
        }
        if ($stage != "") {
            $inner_body = $inner_body . ("It took place in $stage.\n");
        }
        if ($player_tag == $winner) {
        $body = $body . (cool_bar($winner, $winner_score, $player_tag == $winner, $inner_body));
        } else {
        $body = $body . (cool_bar($winner, 0, $player_tag == $winner, $inner_body, $winner_score));
        }
    }

    if ($player_won)
    print(cool_bar($winner, $row[$positionality[$row['winner_id']]], $player_won, $body, $row[$positionality[$loser_id]]));
    else
    print(cool_bar($winner, $row[$positionality[$loser_id]], $player_won, $body, $row[$positionality[$row['winner_id']]]));
}
?>

</body>
</html>