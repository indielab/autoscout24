<?php

namespace Indielab\AutoScout24\Tests;

use PHPUnit\Framework\TestCase;
use Indielab\AutoScout24\Client;

class AutoScoutTestCase extends TestCase
{
    public $client = null;
    
    protected function setUp()
    {
        $this->client = new Client('XXXXX', 'YYYYY');
    }
}
