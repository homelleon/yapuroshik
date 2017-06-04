<?php

namespace Tests\AppBundle\Util;

use AppBundle\Util\Calc;
use PHPUnit\Framework\TestCase;

class CalcTest extends TestCase {
    
    public function testAdd() {
        $calc = new Calc();
        $result = $calc->add(30,12);
        
        $this->assertEquals(42, $result);
    }
}
