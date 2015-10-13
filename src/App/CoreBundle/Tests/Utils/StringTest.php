<?php

namespace App\CoreBundle\Tests\Utils;

use App\CoreBundle\Tests\KernelAwareTest;
use App\CoreBundle\Utils\String;
use App\CoreBundle\Entity\Band;

class StringTest extends KernelAwareTest
{
    /**
     * Test String::getShortClassName() utils method
     */
    public function testGetShortClassName()
    {
        $this->assertEquals('Artist', String::getShortClassName('App\CoreBundle\Entity\Artist'));
        $this->assertEquals('Band', String::getShortClassName('App\CoreBundle\Entity\Band'));
        $this->assertEquals('Artist', String::getShortClassName('\App\CoreBundle\Entity\Artist'));
        $this->assertEquals('Artist', String::getShortClassName('Artist'));
    }
}