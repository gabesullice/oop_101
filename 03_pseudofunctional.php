<?php

function echo_li($content, $class = FALSE) {
  $li = ($class) ? "<li class=\"" . $class . "\">" : "<li>";
  $li .= $content . "</li>";
  echo $li;
}

echo "<ul>";

echo_li('First Content', 'first');

for ($i = 0; $i < 6; $i++) {
  echo_li('Some Content');
}

echo_li('Last Content', 'last');

echo "</ul>";

?>
