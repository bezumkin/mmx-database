<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\Resource;
use MODX\Revolution\modResource;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    public function testDate(): void
    {
        global $modx;

        $dates = [
            'createdon' => time(),
            'editedon' => -1,
            'deletedon' => '',
            'publishedon' => 0,
            'pub_date' => '0',
            'unpub_date' => null,
        ];

        $oldResource = new modResource($modx);
        foreach ($dates as $field => $date) {
            $oldResource->set($field, $date);
        }
        $oldArray = $oldResource->toArray();

        $newResource = new Resource();
        foreach ($dates as $field => $date) {
            $newResource->setAttribute($field, $date);
        }
        $newArray = $newResource->toArray();

        foreach ($dates as $field => $date) {
            $this->assertEquals($oldArray[$field], $newArray[$field]);
        }
    }
}