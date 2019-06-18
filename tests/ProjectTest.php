<?php

namespace App\Tests;

use App\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;

class ProjectTest extends TestCase
{
    use \Laravel\Lumen\Testing\DatabaseMigrations;

    public function testShowMainPage()
    {
        $this->get(route('mainPage'));
        $this->assertResponseOk();
    }

    public function testAddDomain()
    {
        $body = <<<DOC
<!DOCTYPE html>
<html>
    <head>
        <title>Test site</title>
        <meta name="keywords" content="Test keywords">
        <meta name="description" content="Test description">
    </head> 
    <body>
        <h1>Heading</h1>
    </body>
</html>
DOC;

        $mock = new MockHandler([new Response(200, ['Content-Length' => 251], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance('GuzzleHttp\Client', $client);

        $this->post(route('addDomain'), ['url' => 'https://site.com']);
        $this->seeInDatabase('domains', [
            'name' => 'https://site.com',
            'content_length' => 251,
            'response_code' => 200,
            'h1' => 'Heading',
            'keywords' => 'Test keywords',
            'description' => 'Test description',
            'body' => $body
        ]);
    }

    public function testShowDomain()
    {
        DB::table('domains')->insertGetId(
            [
                'name' => 'https://site.com',
                'response_code' => 200,
                'content_length' => 0,
                'h1' => 'Heading',
                'keywords' => 'Test keywords',
                'description' => 'Test description',
                'body' => 'body'
            ]
        );
        $this->get(route('showDomain', ['id' => 1]));
        $this->assertResponseOk();
    }

    public function testShowDomains()
    {
        DB::table('domains')->insertGetId(
            [
                'name' => 'https://site.com',
                'response_code' => 200,
                'content_length' => 0,
                'h1' => 'Heading',
                'keywords' => 'Test keywords',
                'description' => 'Test description',
                'body' => 'body'
            ]
        );
        $this->get(route('showDomains'));
        $this->assertResponseOk();
    }
}
