<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\SystemSetting;
use MODX\Revolution\modSystemSetting;
use PHPUnit\Framework\TestCase;

class SystemSettingTest extends TestCase
{
    public function testDate(): void
    {
        global $modx;
        $time = time();

        $oldSetting = new modSystemSetting($modx);
        $oldSetting->set('editedon', $time);
        $oldArray = $oldSetting->toArray();

        $newSetting = new SystemSetting();
        $newSetting->editedon = $time;
        $newArray = $newSetting->toArray();


        $this->assertEquals($oldArray['editedon'], $newArray['editedon']);
    }
}