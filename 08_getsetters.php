<?php

class element {
  protected $type;
  protected $content; // array of content, either string or element.
  protected $attr; // array of arrays, keyed by attribute name (e.g. array('class' => array('one', 'two'))

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
        if (is_object($line) && is_a($line, 'element')) {
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

class li extends element {
  function __construct($content = NULL, $attr = NULL) {
    $this->type = 'li';
    $this->content = $content;
    $this->attr = $attr;
  }
}

class ul extends element {
  protected $name;

  function __construct($name, $attr = NULL) {
    $this->name = $name;
    $this->type = 'ul';
    $this->attr = $attr;
    $this->content[] = new element('h3', $this->name);

    $this->makeExample();

    return $list;
  }

  function setName($name) {
    $this->name = $name;
    foreach ($this->content as $item) {
      if (get_class($item) == 'element' && $item->type == 'h3') {
        $item->content = $this->name;
        break;
      }
    }
  }

  function addItem($item) {
    $this->content[] = $item;
  }

  private function makeExample() {
    $item = new li('First Content', array('class' => array('first')));
    $this->addItem($item);

    for ($i = 0; $i < 6; $i++) {
      $item = new li('Some Content');
      $this->addItem($item);
    }

    $item = new li('Last Content', array('class' => array('last')));
    $this->addItem($item);
  }
}

$firstList = new ul('My first list object');
$secondList = new ul('My second list object');

$firstList->printElem();
$secondList->printElem();

$firstList->setName('My first list with a new name');
echo $firstLIst->name; // Why does this not print?
$firstList->printElem();

?>
