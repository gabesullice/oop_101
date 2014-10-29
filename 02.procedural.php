<?php

/**
 * With the introduction of compilers and interpreters languages were able to
 * introduce basic concepts like variables and simple conditionals.
 *
 * Loops were quickly added.
 *
 * The strict separation of data and behavior remained, but they were still
 * necessarily coupled.
 * 
 * The function allowed complex behaviors to be written somewhat isolated from
 * input data and reused in many places. This greatly aided in the maintenance
 * of a program as one could write programs such that common behaviors were
 * maintained in one place and updating the structure of your data or coming up
 * with a more performant way of processing it no longer forced you to change
 * your code across 100s and 1000s of different lines. Common programming best
 * practices like Don't Repeat Yourself (DRY) and the Single Responsibilty
 * Principle (SRP) were now possible.
 *
 * Still, because data and behavior remained separate, one had to sacrifice
 * performance for maintainability and flexibility, even if only trivially.
 * 
 * For example, before one could abstract their operations out into funtions,
 * every operation performed on input data could be meticulously tailored to
 * that data. Every loop and conditional could be reasonbly certain of what
 * kind and structure of data it would be working with. In a fucntion that
 * might be reused across a program it now would need to pause and reflect on
 * the data. Where before every print operation in one place could assume every
 * string to print was less than 80 characters and in another it could assume a
 * newline was needed, a central print function would need to assess the length
 * of every line and conditionally insert a newline as necessary. This
 * additional work would slow the process down.
 */

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
