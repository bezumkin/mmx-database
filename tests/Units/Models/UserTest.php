<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\User;
use MODX\Revolution\modUser;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testDate(): void
    {
        global $modx;
        $time = time();

        $oldUser = new modUser($modx);
        $oldUser->set('createdon', $time);
        $oldArray = $oldUser->toArray();

        $newUser = new User();
        $newUser->createdon = $time;
        $newArray = $newUser->toArray();


        $this->assertEquals($oldArray['createdon'], $newArray['createdon']);
    }
}