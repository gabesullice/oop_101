<?php

class element {
  protected $type;
  protected $content; // array of content, either string or element.
  protected $attr; // array of arrays, keyed by attribute name (e.g. array('class' => array('one', 'two'))

  public function __construct($type, $content = NULL, $attr = NULL) {
    $this->type = $type;
    $this->addContent($content);
    $this->attr = $attr;
  }

  public function addContent($content) {
    if (is_array($content)) {
      foreach ($content as $item) {
        $this->content[] = $item;
      }
    }
    elseif (is_a($content, 'element') || is_string($content)) {
      $this->content[] = $content;
    }
  }

  public function render() {
    $type = $this->type;
    $attr = $this->renderAttr();
    $content = $this->renderContent();

    return sprintf("<%s%s>%s</%s>\n",
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
        $content .= $item->render();
      }
      elseif (is_string($item)) {
        $content .= $item;
      }
    }
    return $content;
  }

  protected function renderAttr() {
    $content = "";
    if (isset($this->attr)) {
      foreach ($this->attr as $name => $values) {
        $content .= sprintf(" %s=\"%s\" ",
          $name,
          implode(' ', $values)
        );
      }
    }
    return $content;
  }

}

class li extends element {
  public function __construct($content = NULL, $attr = NULL) {
    parent::__construct('li', $content, $attr);
  }
}

class ul extends element {
  public $name;

  public function __construct($name, $attr = NULL) {
    $this->name = $name;
    parent::__construct('ul', array(new element('h3', $this->name)), $attr);
    $this->makeExample();
  }

  private function makeExample() {
    $item = new li('First Content', array('class' => array('first')));
    $this->addContent($item);

    for ($i = 0; $i < 6; $i++) {
      $item = new li('Some Content');
      $this->addContent($item);
    }

    $item = new li('Last Content', array('class' => array('last')));
    $this->addContent($item);
  }
}

$firstList = new ul('My first list object');
$secondList = new ul('My second list object');

print $firstList->render();
print $secondList->render();

$firstLIst->name = 'My first list with a new name';
print $firstLIst->name;
print $firstList->render(); // Why does this not print the new name?

?>
