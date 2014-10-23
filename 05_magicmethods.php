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

  function __construct($name) {
    $this->name = $name;

    $item = new element('li', array('First Content'), array('class' => array('first')));
    $this->addItem($item);

    for ($i = 0; $i < 6; $i++) {
      $item = new element('li', array('Some Content'));
      $this->addItem($item);
    }

    $item = new element('li', array('Last Content'), array('class' => array('last')));
    $this->addItem($item);

    return $list;
  }

  function addItem($item) {
    $this->items[] = $item;
  }

  function printList() {
    $h3 = new element('h3', array($this->name));
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
