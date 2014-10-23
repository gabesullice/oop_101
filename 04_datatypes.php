<?php

class element {
  var $type;
  var $attr; // array of arrays, keyed by attribute name (e.g. array('class' => array('one', 'two'))
  var $content; // array of content, either string or element.

  function printElem() {
    echo "<" . $this->type . " ";

    if (isset($this->attr)) {
      foreach ($this->attr as $name => $values) {
        echo $name . "=\"" . implode(' ', $values)  . "\" ";
      }
    }

    echo ">";

    foreach ($this->content as $line) {
      if (is_object($line) && get_class($line) == 'element') {
        $line->printElem();
      }
      else {
        echo $line;
      }
    }

    echo "</" . $this->type . ">\n";
  }
}

class listClass {
  var $name;
  var $items;

  function addItem($item) {
    $this->items[] = $item;
  }

  function printList() {
    $ul = new element;
    $ul->type = 'ul';

    $h3 = new element;
    $h3->type = 'h3';
    $h3->content = array($this->name);

    array_unshift($this->items, $h3);

    $ul->content = $this->items;

    $ul->printElem();
  }
}

function makeList($name) {
  $list = new listClass;
  $list->name = $name;

  $item = new element;
  $item->type = 'li';
  $item->attr = array('class' => array('first'));
  $item->content = array('First Content');
  $list->addItem($item);

  for ($i = 0; $i < 6; $i++) {
    $item = new element;
    $item->type = 'li';
    $item->content = array('Some Content');
    $list->addItem($item);
  }

  $item = new element;
  $item->type = 'li';
  $item->attr = array('class' => array('last'));
  $item->content = array('Last Content');
  $list->addItem($item);

  return $list;
}

$firstList = makeList('My first list object');
$secondList = makeList('My second list object');

$firstList->printList();
$secondList->printList();

?>
