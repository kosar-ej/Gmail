<?php
use PHPUnit\Framework\TestCase;


class UrlTest extends TestCase
{

    public function testInboxUrl()
    {
        $url = 'http://localhost/Gmail/home.php';
        $headers = get_headers($url);
        $this->assertStringContainsString('200', $headers[0]);
    }

    public function testSendEmailUrl()
    {
        $url = 'http://localhost/Gmail/sent.php';
        $headers = get_headers($url);
        $this->assertStringContainsString('200', $headers[0]);
    }

    public function testSingleEmailInboxUrl()
    {
        $url = 'http://localhost/Gmail/singleEmailInbox.php?id=5';
        $headers = get_headers($url);
        $this->assertStringContainsString('200', $headers[0]);
    }

    public function testSingleEmailSentUrl()
    {
        $url = 'http://localhost/Gmail/singleEmailSent.php?id=23';
        $headers = get_headers($url);
        $this->assertStringContainsString('200', $headers[0]);
    }

    public function testDeleteInboxUrl()
    {
        $url = 'http://localhost/Gmail/deleteInbox.php?id=27';
        $headers = get_headers($url);
        $this->assertStringContainsString('200', $headers[0]);
    }

    
    public function testUpdateEmailUrl()
    {
        $url = 'http://localhost/Gmail/updateEmail.php?id=24';
        $headers = get_headers($url);
        $this->assertStringContainsString('200', $headers[0]);
    }
}
