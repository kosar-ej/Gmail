<?php
use PHPUnit\Framework\TestCase;

class EmailViewTest extends TestCase
{
    public function testViewInboxEmail()
    {
        $url = 'http://localhost/Gmail/singleEmailInbox.php?id=21'; 

        $headers = get_headers($url);

        $this->assertStringContainsString('200', $headers[0]);

        $content = file_get_contents($url);

        // Expected email data
        $emailData = [
            'subject' => 'MyJob',
            'content' => 'FrontEnd Developer',
        ];

        $this->assertStringContainsString($emailData['subject'], $content);
        $this->assertStringContainsString($emailData['content'], $content);
    }

    public function testViewSentEmail()
    {
        $url = 'http://localhost/Gmail/singleEmailSent.php?id=23'; 

        $headers = get_headers($url);

        $this->assertStringContainsString('200', $headers[0]);

        $content = file_get_contents($url);

        // Expected email data
        $emailData = [
            'subject' => 'greeting to every one',
            'content' => 'hello world!!!',
        ];

        $this->assertStringContainsString($emailData['subject'], $content);
        $this->assertStringContainsString($emailData['content'], $content);
    }
}
