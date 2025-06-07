# jdwx/html5

Simple PHP module for building valid HTML5 from raw elements.

## Installation

You can require it from Composer:

```bash
composer require jdwx/html5
```

Or download the source from GitHub: https://github.com/jdwx/html5.git

## Requirements

This module requires PHP 8.3 or later.

## Usage

This module provides PHP for handling HTML elements and attributes.

```php

$div = ( new \JDWX\HTML5\Elements\Div( 'foo' ) )->class( 'bar' )->style( 'display: none' );
echo $div; # Prints <div class="bar">foo</div>
```

Attributes provide two interfaces. The first is an orthogonal interface that provides the same methods for every attribute:

* addFoo(): Add content to the foo attribute of the element
* getFoo(): Get the value of the element's foo attribute
* hasFoo(): Element has attribute (either at all, or with optional specific value)
* setFoo(): Set the foo attribute of the element, overwriting whatever is already there.

The second is a method named for the attribute (e.g., "class" in the example above) that tries to take a more intuitive value that it may use to add to or set that attribute. E.g., class() takes a string and adds it to the list of classes, maxLength() takes an int and sets the attribute to that value, and checked() takes a bool that indicates whether the checked attribute should be displayed or not.

Much of the code in this library is generated from scripts. So while not every element and attribute is currently included, it is generally quite easy to add something missing when the need arises.

## Stability

This module has complete test coverage. It is widely used internally and believed reliable. The functionality here is not rocket science.

New elements and attributes are so low-impact that they may be added in patch releases.

The attribute interface should be relatively stable. It would be nice for the child element interface to gain some more DOM-like query/selector functionality. If that's done in a way that impairs backward compatibility, the major version number will be increased.

PHP 8.4 is actively working on the longstanding drawbacks of the (XHTML-focused) DOM extension when dealing with HTML5, so it is possible future major version updates of this may drift in that direction.

## History

This module was originally a toy project. That project was essentially overwritten and replaced in May 2025 with the results of refactoring fully four separate ad hoc implementations of similar code into one set of common functionality that does all the things.
