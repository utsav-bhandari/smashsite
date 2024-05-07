<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage-styles.css">
    <title>Ultimate data</title>
</head>
<body>

<?php
  $fighters = ["Mario", "Donkey Kong", "Link", "Samus", "Dark Samus", "Yoshi", "Kirby", "Fox", "Pikachu", "Luigi", "Ness", "Captain Falcon", "Jigglypuff", "Peach", "Daisy", "Bowser", "Ice Climbers", "Sheik", "Zelda", "Dr. Mario", "Pichu", "Falco", "Marth", "Lucina", "Young Link", "Ganondorf", "Mewtwo", "Roy", "Chrom", "Mr. Game & Watch", "Meta Knight", "Pit", "Dark Pit", "Zero Suit Samus", "Wario", "Snake", "Ike", "Pokemon Trainer", "Diddy Kong", "Lucas", "Sonic", "King Dedede", "Olimar", "Lucario", "R.O.B.", "Toon Link", "Wolf", "Villager", "Mega Man", "Wii Fit Trainer", "Rosalina & Luma", "Little Mac", "Greninja", "Palutena", "Pac-Man", "Robin", "Shulk", "Bowser Jr.", "Duck Hunt", "Ryu", "Ken", "Cloud", "Corrin", "Bayonetta", "Inkling", "Ridley", "Simon", "Richter", "King K. Rool", "Isabelle", "Incineroar", "Piranha Plant", "Joker", "Hero", "Banjo & Kazooie", "Terry", "Byleth", "Min Min", "Steve", "Sephiroth", "Pyra / Mythra", "Kazuya", "Sora", "Mii Brawler", "Mii Swordfighter", "Mii Gunner"];
  $row_len = 13;
?>

<form action="filtertagpage.php" method="get">
<div class="dropdown">
    <div id="theDropdown" class="dropdown-content">
        <input type="text" placeholder="Search player..." id="theInput" name="playertag">
        <input type="submit" value="submit">
    </div>
</div>
</form>

<div class="roster">
    <table>
        <?php
        for ($i = 0; $i < count($fighters); $i += 1) {
          if ($i % $row_len == 0) {
              print("<tr>");
          }
          print("<td>\n");
          $uppername = strtoupper($fighters[$i]);
          if ($uppername == "MII SWORDFIGHTER") $uppername = "MII S. FIGHTER";
          if ($uppername == "WII FIT TRAINER") $uppername = "Wii Fit TRAINER";
          print("<div style='position: absolute;width: inherit;height: inherit;'>");
          $name = $fighters[$i];
          if ($name == "Donkey Kong") $name = "Donkeykong";
          if ($name == "Dark Samus") $name = "Darksamus";
          if ($name == "Captain Falcon") $name = "Captainfalcon";
          if ($name == "Ice Climbers") $name = "Iceclimbers";
          if ($name == "Dr. Mario") $name = "Drmario";
          if ($name == "Young Link") $name = "Younglink";
          if ($name == "Mr. Game & Watch") $name = "Mrgameandwatch";
          if ($name == "Meta Knight") $name = "Metaknight";
          if ($name == "Dark Pit") $name = "Darkpit";
          if ($name == "Zero Suit Samus") $name = "Zerosuitsamus";
          if ($name == "Pokemon Trainer") $name = "Pokemontrainer";
          if ($name == "Diddy Kong") $name = "Diddykong";
          if ($name == "King Dedede") $name = "Kingdedede";
          if ($name == "R.O.B.") $name = "Rob";
          if ($name == "Toon Link") $name = "Toonlink";
          if ($name == "Mega Man") $name = "Megaman";
          if ($name == "Wii Fit Trainer") $name = "Wiifittrainer";
          if ($name == "Rosalina & Luma") $name = "Rosalina";
          if ($name == "Little Mac") $name = "Littlemac";
          if ($name == "Bowser Jr.") $name = "Bowserjr";
          if ($name == "Duck Hunt") $name = "Duckhunt";
          if ($name == "King K. Rool") $name = "Kingkrool";
          if ($name == "Piranha Plant") $name = "Piranhaplant";
          if ($name == "Banjo & Kazooie") $name = "Banjokazooie";
          if ($name == "Min Min") $name = "Minmin";
          if ($name == "Pyra / Mythra") $name = "Pyra";
          if ($name == "Mii Brawler") $name = "Mii";
          if ($name == "Mii Swordfighter") $name = "Mii";
          if ($name == "Mii Gunner") $name = "Mii";
          $lower = strtolower($name);
          print("<a href=\"characterinfo.php?character=$lower\">");
          print("<img src='../smash_images/{$name}.png' alt='{$fighters[$i]}'>");
          print("</a>");
          print("<p class='fighter-name'>{$uppername}</p>");
          print("</div>");
          print("</td>\n");
          if ($i + 1 / $row_len == 1) {
              print("</tr>");
          }
        }
        ?>
    </table>
</div>

</body>
</html>
