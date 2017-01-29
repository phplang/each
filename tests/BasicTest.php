<?php

require __DIR__ . '/../vendor/autoload.php';

class BasicTest extends PHPUnit_Framework_TestCase {
  public function testLoop() {
    $data1 = $data2 = [
      1 => 2,
      3 => 4,
      5 => null,
      6 => false,
      7 => [1,2,3],
      8 => (object)[4,5,6],
    ];
    while (($p1 = \each($data1)) && ($p2 = \PhpLang\each($data2))) {
      $this->assertSame($p1, $p2);
    }
    $this->assertSame(null, \key($data1));
    $this->assertSame(null, \key($data2));
  }
}
