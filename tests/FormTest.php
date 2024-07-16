<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class EmailFormTest extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'errors' => [
                    'user_to' => '2',
                    'subject' => 'hello',
                    'content' => 'hello world!!!'
                ]
            ]))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handlerStack, 'base_uri' => 'http://localhost/Gmail']);
    }

    public function testComposeEmailFormValidation()
    {
        $data = [
            'user_to' => '',     
            'subject' => '',     
            'content' => ''      
        ];

        $response = $this->post('/compose.php', $data);

        $this->assertNotEquals(302, $response->getStatusCode());

        $responseBody = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('errors', $responseBody);
        $this->assertArrayHasKey('user_to', $responseBody['errors']);
        $this->assertArrayHasKey('subject', $responseBody['errors']);
        $this->assertArrayHasKey('content', $responseBody['errors']);
    }

    protected function post($uri, $data)
    {
        $response = $this->client->post($uri, [
            'form_params' => $data
        ]);

        return $response;
    }
}
