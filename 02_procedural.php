<?php

/**
 * ============================================================================
 * Programming before loops
 * ============================================================================
 */

echo "<ul>";
echo "  <li class=\"first\">First Content</li>";


$i = 0;

echoline:
echo "  <li>Some Content</li>";
$i = $i + 1;

if ($i < 6) goto echoline;


echo "  <li class=\"last\">Last Content</li>";
echo "</ul>";

/**
 * ============================================================================
 * Programming with loops, w/o functions
 * ============================================================================
 */

echo "<ul>";
echo "  <li class=\"first\">First Content</li>";
for ($i = 0; $i < 6; $i++) {
  echo "  <li>Some Content</li>";
}
echo "  <li class=\"last\">Last Content</li>";
echo "</ul>";

/**
 * ============================================================================
 * Programming with functions
 * ============================================================================
 */

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
