<?php

abstract class element {
  protected $content = array(); // array of content, either string or element.
  protected $attr = array(); // array of arrays, keyed by attribute name (e.g. array('class' => array('one', 'two'))

  function __construct($content = NULL, $attr = NULL) {
    if ($content) $this->addContent($content);
    if ($attr) $this->addAttr($attr);
  }

  public function addContent($content) {
    if (is_array($content)) {
      foreach ($content as $item) {
        $this->content[] = $item;
      }
    }
    elseif (is_string($content)) {
      $this->content[] = $content;
    }
  }

  public function addAttr($attr) {
    $this->attr = array_merge_recursive($this->attr, $attr);
  }

  public function render() {
    $type = $this->type;
    $attr = $this->renderAttr();
    $content = $this->renderContent();

    return sprintf("<%s %s>%s</%s>\n",
      $type,
      $attr,
      $content,
      $type
    );
  }

  protected function renderContent() {
    $content = "";
    foreach ($this->content as $item) {
      if (is_object($item) && is_a($item, 'element')) {
        $content .= $line->render();
      }
      elseif (is_string($item)) {
        $content .= $line;
      }
    }
    return $content;
  }

  protected function renderAttr() {
    $content = "";
    if (isset($this->attr)) {
      foreach ($this->attr as $name => $values) {
        $content .= sprintf("%s=\"%s\" ",
          $name,
          implode(' ', $values)
        );
      }
    }
    return $content;
  }
}

class h3 extends element {
  static protected $type = 'h3'; 
}

class li extends element {
  static protected $type = 'li'; 
}

class ul extends element {
  static protected $type = 'ul';
  protected $name;

  function __construct($name, $attr = NULL) {
    $this->setName($name);
    $this->makeExample();
    parent::__construct(NULL, $attr);
  }

  function setName($name) {
    if (isset($this->content[0]) && is_a($this->content[0], 'h3')) {
      $this->content[0] = array($name);
    }
    else {
      $heading = new h3($name);
      array_unshift($this->content, $heading);
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

$firstList->render();
$secondList->render();

?>
