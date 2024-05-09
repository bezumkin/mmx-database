<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\ContextSetting;
use MODX\Revolution\modContextSetting;
use PHPUnit\Framework\TestCase;

class ContextSettingTest extends TestCase
{
    public function testDate(): void
    {
        global $modx;
        $time = time();

        $oldSetting = new modContextSetting($modx);
        $oldSetting->set('editedon', $time);
        $oldArray = $oldSetting->toArray();

        $newSetting = new ContextSetting();
        $newSetting->editedon = $time;
        $newArray = $newSetting->toArray();


        $this->assertEquals($oldArray['editedon'], $newArray['editedon']);
    }
}