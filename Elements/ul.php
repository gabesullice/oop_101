<?php

namespace Elements;

class ul extends element {
  protected $type = 'ul';
  protected $name;

  protected function type() { return $this->type; }

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
