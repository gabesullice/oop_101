<?php

echo "<ul>";
echo "  <li class=\"first\">First Content</li>";


$i = 0;

echoline:
echo "  <li>Some Content</li>";
$i = $i + 1;

if ($i < 6) goto echoline;


echo "  <li class=\"last\">Last Content</li>";
echo "</ul>";

echo "<ul>";
echo "  <li class=\"first\">First Content</li>";
for ($i = 0; $i < 6; $i++) {
  echo "  <li>Some Content</li>";
}
echo "  <li class=\"last\">Last Content</li>";
echo "</ul>";

?>
