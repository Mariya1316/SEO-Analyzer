<?php

class ProjectTest extends TestCase
{
    use Laravel\Lumen\Testing\DatabaseMigrations;

    public function testShowMainPage()
    {
        $this->get(route('mainPage'));
        $this->assertResponseOk();
    }

    public function testAddDomain()
    {
        $this->post(route('addDomain'), ['url' => 'https://www.google.com']);
        $this->seeInDatabase('domains', ['name' => 'https://www.google.com']);
    }
    public function testShowDomain()
    {
        $this->post(route('addDomain'), ['url' => 'https://www.google.com']);
        $this->get(route('showDomain', ['id' => 1]));
        $this->assertResponseOk();
    }
}
