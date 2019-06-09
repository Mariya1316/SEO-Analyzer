<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->get('/');
        $this->assertResponseOk();
    }

    public function testDomainsTable()
    {
        $this->seeInDatabase('domains', ['title' => 'dotdev.co']);
    }
}
