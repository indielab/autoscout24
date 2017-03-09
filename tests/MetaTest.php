<?php

namespace Indielab\AutoScout24\Tests;

use Indielab\AutoScout24\MetaQuery;

class MetaTest extends AutoScoutTestCase
{
    public function testPkwMeta()
    {
        $f = (new MetaQuery())->setClient($this->client)->findPkw();
        
        foreach ($f as $meta) {
            $this->assertNotEMpty($meta->getParameterName());
        }
    }
    
    public function testPkwMetaFilterSort()
    {
        $item = (new MetaQuery())->setClient($this->client)->findPkw()->sort();
        
        $this->assertSame('sort', $item->getParameterName());
    }
}