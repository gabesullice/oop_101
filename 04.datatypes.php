<?php

/**
In this example, we're simply illustrating the concept of creating new
datatypes. Simply put, classes can be thought of just as any other
traditional type, like strings, integers, floats, etc. When we create a class
we're defining a single conceptual thing which stores multiple pieces of data.
Just as a string might be considered just a data structure that contains a
varaible number of chars, listClass might contain a variable number of 'element's

Note that what we're doing here is not yet inheritance. ListClass is composed
of elements, but it is not an element itself.

Being able to abstract your data out into their own types is another
illustration of the idea of encapsulation. We first saw this idea in just the
use of our first class, listClass, but now we've taken it a step further. By
encapsulating the logic of how to print an element within the element class, we
are able to reduce the surface aread of what listClass needs to be concerned
with. it no longer has any logic for printing htlm characters like opening and
closing tags. It need only know that it consists of a name, a set of items, and
that it's printable. It doesn't even need to know how to print the elements it 
contains any more.

By encapsulating the concept of an element into its own class, we can more
easily extend it. Note that within the printElem() method, we actually have a
call to printElem(). What is going on is that we've baked in the idea of nested
elements right into the element type itself. By creating element, we've made it
possible to represent an entire HTML document, not just a list, and we've barely
added any code, if any.
*/

class element {
  var $type; // The type of element that this class could be.
  var $attr; // array of arrays, keyed by attribute name (e.g. array('class' => array('one', 'two'))
  var $content; // array of content, either string or element.

  /**
   * Prints this element and all its children recusively.
   */
  function printElem() {
    echo "<" . $this->type . " ";

    if (isset($this->attr)) { // If the element has attributes, print them.
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
