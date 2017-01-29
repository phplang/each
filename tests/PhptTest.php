<?php

require __DIR__ . '/../vendor/autoload.php';

class EachTest extends PHPUnit_Framework_TestCase {
  public function testZendEach001() { // Zend/tests/each_001.phpt
    $caught = null;
    $oldeh = \set_error_handler(function($errno, $errstr) use (&$caught) {
      $caught = $errstr;
      return true;
    }, E_USER_WARNING);
    \PhpLang\each($foo);
    \set_error_handler($oldeh);
    $this->assertSame("Variable passed to each() is not an array or object", trim($caught));
  }

  public function testZendEach002() { // Zend/tests/each_002.phpt
    $a = new stdClass;
    $foo = \PhpLang\each($a);
    $this->assertSame($foo, false);

    $a = new stdClass;
    $this->assertSame(\PhpLang\each($a), false);

    $c = new stdClass;
    $a = array($c);
    $this->assertSame(\PhpLang\each($a), [
      1 => $c,
      'value' => $c,
      0 => 0,
      'key' => 0,
    ]);
  }

  public function testZendEach003() { // Zend/tests/each_003.phpt
    $ini = ini_get('zend.enable_gc');
    ini_set('zend.enable_gc', 1);

    $a = array(array());
    $a[] =& $a;
    $this->assertSame(\PhpLang\each($a[1]), [
      1 => [],
      'value' => [],
      0 => 0,
      'key' => 0,
    ]);

    ini_set('zend.enable_gc', $ini);
  }
}
