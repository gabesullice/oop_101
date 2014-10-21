<?php

class listClass {
  var $name;
  var $items;

  function addItem($content, $class = FALSE) {
    $this->items[] = array(
      'content' => $content,
      'class' => $class,
    );
  }

  function printList() {
    echo "<ul>";
    echo "<h3>" . $this->name . "</h3>";

    foreach ($this->items as $item) {
      $li = ($item['class']) ? "<li class=\"" . $item['class'] . "\">" : "<li>";
      $li .= $item['content'] . "</li>";
      echo $li;
    }

    echo "</ul>";
  }
}

function makeList($name) {
  $list = new listClass;
  $list->name = $name;

  $list->addItem('First Content', 'first');
  for ($i = 0; $i < 6; $i++) {
    $list->addItem('Some Content');
  }
  $list->addItem('Last Content', 'last');

  return $list;
}

$firstList = makeList('My first list object');
$secondList = makeList('My second list object');

$firstList->printList();
$secondList->printList();

?>
