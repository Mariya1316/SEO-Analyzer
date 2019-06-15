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
        $this->post(route('addDomain'), ['url' => 'https://ru.hexlet.io']);
        $this->seeInDatabase('domains', ['name' => 'https://ru.hexlet.io']);
    }

    public function testShowDomain()
    {
        $this->post(route('addDomain'), ['url' => 'https://ru.hexlet.io']);
        $this->get(route('showDomain', ['id' => 1]));
        $this->assertResponseOk();
    }
    
    public function testShowDomains()
    {
        $this->post(route('addDomain'), ['url' => 'https://ru.hexlet.io']);
        $this->get(route('showDomains'));
        $this->assertResponseOk();
    }
}
