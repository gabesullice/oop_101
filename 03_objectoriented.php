<?php

/*
Object Oriented programming has many definitions and implementations. However,
a fundamental constant of OOP that holds true among its many different
approaches is the marriage of data and behavior. That is, within a single
'thing', we are able to provide both the information we want to store or
present as well as the behaviors we want to have act upon or based upon that
data.

For example, where previously we defined functions to which we could pass some
data, like content for a list element, and we needed to concern ourselves with
exactly how that funtion was implemented (i.e. did it or didn't it print
wrapping <ul> tags?) now we can create an abstraction of a list. This new thing,
or class, ought to know how to print itself and how to handle additional
pieces of content.

As mentioned above, this new thing we have is, in PHP, called a class. A
class is simply a container in which we can define both data and behaviors.
This unison of data and behaviors means we can define generic functions like 
printList() and no longer concern ourselves with printing wrapping <ul> tags.
As far as an outside user of our class is concerned, they need only know that
they can add to the list with addItem() and print it with printList().

These classes can also contain related and 'meta' information where
previously that information was contained in the head of a developer or
implicitly existant in our code. In our list class, we've added a piece of
information like that with a property called 'name'. A property is simply a
constant or variable implemented within a class definition. Now, no matter 
what variable we assign an instance of our listClass to, or even possibly we
use it without assigning it to a variable, it will always have a name.
*/

class listClass {
  /**
   * These are properties.
   *
   * They are properties because they are within the listClass block, but
   * outside of a function definition.
   */
  var $name; // This is a property.
  var $items; // This too.

  /**
   * Thie is a method.
   * 
   * We call it a method because it is defined within the context of a class.
   */
  function addItem($content, $class = FALSE) {
    /**
     * Here, we are referencing and setting a property of this class.
     *
     * We use the -> operator and the magic $this variable to access properties
     * of the class.
     * 
     * Note that $content and $class are simply variables, not properties. They
     * are defined within the scope of a functions and are only accessible
     * witin the function body.
     */
    $this->items[] = array( 
      'content' => $content,
      'class' => $class,
    );
  }

  /**
   * Another method.
   */
  function printList() {
    echo "<ul>";
    // Another reference to a property.
    echo "<h3>" . $this->name . "</h3>";

    // Accessing a property again.
    foreach ($this->items as $item) {
      $li = ($item['class']) ? "<li class=\"" . $item['class'] . "\">" : "<li>";
      $li .= $item['content'] . "</li>";
      echo $li;
    }

    echo "</ul>";
  }
}

/**
 * This is a simple function. Not a method. That's because it is outside the
 * class definition.
 */
function makeList($name) {
  /**
   * To create an instance of a class. We use the 'new' keyword.
   * 
   * When you create a new instance of a class, you're creating an 'object'.
   * You can think of a class like a blueprint and every instance of it, or
   * every object, like the real copy that exists in the world.
   * 
   * object:class :: node:content_type
   */
  $list = new listClass; // We assing our new listClass object to the var $list.

  // Now we can access properites of our object with the -> operator
  $list->name = $name;

  // To call a method, you need to access it with the -> operator too.
  $list->addItem('First Content', 'first');
  for ($i = 0; $i < 6; $i++) {
    $list->addItem('Some Content');
  }
  $list->addItem('Last Content', 'last');

  // We can return objects just like any other variable.
  return $list;
}

$firstList = makeList('My first list object');
$secondList = makeList('My second list object');

/**
 * Note that outside of the class definition we haven't had to concern
 * ourselves with implementation like markup at all.
 * 
 * For all we care, this could have been written by anyone with only some basic
 * basic documentation and we would never need to copy and paste code to print
 * things we ought to not have to worry about..
 */
$firstList->printList();
$secondList->printList();

?>
