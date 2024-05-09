<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\UserProfile;
use MODX\Revolution\modUserProfile;
use PHPUnit\Framework\TestCase;

class UserProfileTest extends TestCase
{
    public function testDate(): void
    {
        global $modx;
        $time = time();

        $dates = ['blockeduntil', 'blockedafter', 'thislogin', 'lastlogin'];

        $oldProfile = new modUserProfile($modx);
        foreach ($dates as $date) {
            $oldProfile->set($date, $date === 'lastlogin' ? 0 : $time);
        }
        $oldArray = $oldProfile->toArray();

        $newUser = new UserProfile();
        foreach ($dates as $date) {
            $newUser->setAttribute($date, $date === 'lastlogin' ? 0 : $time);
        }
        $newArray = $newUser->toArray();

        foreach ($dates as $date) {
            $this->assertEquals($oldArray[$date], $newArray[$date]);
        }
    }
}