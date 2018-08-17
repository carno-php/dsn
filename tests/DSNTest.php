<?php
/**
 * DSN test
 * User: moyo
 * Date: 2018/8/17
 * Time: 10:53 AM
 */

namespace Carno\DSN\Tests;

use Carno\DSN\DSN;
use PHPUnit\Framework\TestCase;

class DSNTest extends TestCase
{
    public function testParser()
    {
        $test1 = new DSN('mysql://user:pass@rds.cloud:3309/db_test?charset=utf8mb4&timeout=1000&keepalive');

        $this->assertEquals('mysql', $test1->scheme());
        $this->assertEquals('rds.cloud', $test1->host());
        $this->assertEquals(3309, $test1->port());
        $this->assertEquals('user', $test1->user());
        $this->assertEquals('pass', $test1->pass());
        $this->assertEquals('db_test', $test1->path());
        $this->assertEquals('utf8mb4', $test1->option('charset'));
        $this->assertEquals(1000, $test1->option('timeout'));
        $this->assertEquals(true, $test1->option('keepalive'));
        $this->assertEquals(null, $test1->option('timeout2'));
        $this->assertEquals(200, $test1->option('timeout3', 200));
    }
}
