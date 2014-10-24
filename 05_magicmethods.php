<?php

class element {
  var $type;
  var $content; // array of content, either string or element.
  var $attr; // array of arrays, keyed by attribute name (e.g. array('class' => array('one', 'two'))

  function __construct($type, $content = NULL, $attr = NULL) {
    $this->type = $type;
    $this->content = $content;
    $this->attr = $attr;
  }

  function printElem() {
    echo "<" . $this->type . " ";

    if (isset($this->attr)) {
      foreach ($this->attr as $name => $values) {
        echo $name . "=\"" . implode(' ', $values)  . "\" ";
      }
    }

    echo ">";

    if (is_array($this->content)) {
      foreach ($this->content as $line) {
        if (is_object($line) && get_class($line) == 'element') {
          $line->printElem();
        }
        elseif (is_string($line)) {
          echo $line;
        }
      }
    }
    elseif (is_string($this->content)) {
      echo $this->content;
    }

    echo "</" . $this->type . ">\n";
  }
}

class listClass {
  var $name;
  var $items;

  function __construct($name) {
    $this->name = $name;

    $this->makeExample();

    return $list;
  }

  function addItem($item) {
    $this->items[] = $item;
  }

  function makeExample() {
    $item = new element('li', 'First Content', array('class' => array('first')));
    $this->addItem($item);

    for ($i = 0; $i < 6; $i++) {
      $item = new element('li', 'Some Content');
      $this->addItem($item);
    }

    $item = new element('li', 'Last Content', array('class' => array('last')));
    $this->addItem($item);
  }

  function printList() {
    $h3 = new element('h3', $this->name);
    array_unshift($this->items, $h3);
    $ul = new element('ul', $this->items);
    $ul->printElem();
  }
}

$firstList = new listClass('My first list object');
$secondList = new listClass('My second list object');

$firstList->printList();
$secondList->printList();

?>
