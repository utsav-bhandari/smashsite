<?php
function exit_nicely($text)
{
    print ($text);
    print ("</body>\n</html>\n");
    exit();
}
