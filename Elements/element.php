<?php

namespace Elements;

abstract class element {
  protected $content = array(); // array of content, either string or element.
  protected $attr = array(); // array of arrays, keyed by attribute name (e.g. array('class' => array('one', 'two'))

  function __construct($content = NULL, $attr = NULL) {
    if ($content) $this->addContent($content);
    if ($attr) $this->addAttr($attr);
  }

  abstract protected function type();

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
    $type = $this->type();
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
      if (is_object($item) && is_a($item, 'Elements\element')) {
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
