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
        $time = time();

        $dates = ['createdon', 'editedon', 'deletedon', 'publishedon', 'pub_date', 'unpub_date'];

        $oldResource = new modResource($modx);
        foreach ($dates as $date) {
            $oldResource->set($date, $date === 'unpub_date' ? 0 : $time);
        }
        $oldArray = $oldResource->toArray();

        $newResource = new Resource();
        foreach ($dates as $date) {
            $newResource->setAttribute($date, $date === 'unpub_date' ? 0 : $time);
        }
        $newArray = $newResource->toArray();

        foreach ($dates as $date) {
            $this->assertEquals($oldArray[$date], $newArray[$date]);
        }
    }
}