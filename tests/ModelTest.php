<?php
use PHPUnit\Framework\TestCase;

class EmailModelTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=gmail', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testInsertEmail()
    {
        $emailData = [
            'user_from' => '5',
            'user_to' => '1',
            'subject' => 'Inser email test',
            'content' => 'This is a test for inserting email to data base.',
        ];

        $stmt = $this->pdo->prepare("
            INSERT INTO emails (user_from, user_to, subject, content, created_at) 
            VALUES (:user_from, :user_to, :subject, :content, NOW())
        ");
        $result = $stmt->execute($emailData);

        $this->assertTrue($result);

        $stmt = $this->pdo->prepare("
            SELECT * FROM emails 
            WHERE user_from = :user_from AND user_to = :user_to AND subject = :subject AND content = :content
        ");
        $stmt->execute([
            'user_from' => '5',
            'user_to' => '1',
            'subject' => 'Inser email test',
            'content' => 'This is a test for inserting email to data base.'
        ]);
        $email = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($email);
        $this->assertEquals($emailData['user_from'], $email['user_from']);
        $this->assertEquals($emailData['user_to'], $email['user_to']);
        $this->assertEquals($emailData['subject'], $email['subject']);
        $this->assertEquals($emailData['content'], $email['content']);
    }

    public function testUpdateEmail()
    {
        $emailData = [
            'user_from' => '5',
            'user_to' => '1',
            'subject' => 'Test Email',
            'content' => 'This is a test email.',
        ];

        $stmt = $this->pdo->prepare("
            INSERT INTO emails (user_from, user_to, subject, content, created_at) 
            VALUES (:user_from, :user_to, :subject, :content, NOW())
        ");
        $stmt->execute($emailData);

        $updatedEmailData = [
            'user_from' => '5',
            'user_to' => '1',
            'subject' => 'Updated Email',
            'content' => 'This is an updated test email.',
        ];

        $stmt = $this->pdo->prepare("
            UPDATE emails
            SET subject = :subject, content = :content, created_at = NOW()
            WHERE user_from = :user_from AND user_to = :user_to
        ");
        $result = $stmt->execute($updatedEmailData);

        $this->assertTrue($result);

        $stmt = $this->pdo->prepare("
            SELECT * FROM emails 
            WHERE user_from = :user_from AND user_to = :user_to AND subject = :subject AND content = :content
        ");
        $stmt->execute($updatedEmailData);
        $email = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($email);
        $this->assertEquals($updatedEmailData['user_from'], $email['user_from']);
        $this->assertEquals($updatedEmailData['user_to'], $email['user_to']);
        $this->assertEquals($updatedEmailData['subject'], $email['subject']);
        $this->assertEquals($updatedEmailData['content'], $email['content']);
    }

    public function testDeleteEmail()
    {
        $emailData = [
            'user_from' => '5',
            'user_to' => '1',
            'subject' => 'Test Email',
            'content' => 'This is a test email.',
        ];

        $stmt = $this->pdo->prepare("
            INSERT INTO emails (user_from, user_to, subject, content, created_at) 
            VALUES (:user_from, :user_to, :subject, :content, NOW())
        ");
        $stmt->execute($emailData);

        $stmt = $this->pdo->prepare("
            DELETE FROM emails 
            WHERE user_from = :user_from AND user_to = :user_to AND subject = :subject AND content = :content
        ");
        $result = $stmt->execute($emailData);

        $this->assertTrue($result);

        $stmt = $this->pdo->prepare("
            SELECT * FROM emails 
            WHERE user_from = :user_from AND user_to = :user_to AND subject = :subject AND content = :content
        ");
        $stmt->execute($emailData);
        $email = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertFalse($email);
    }

    public function testReadEmail()
    {
        $emailData = [
            'user_from' => '5',
            'user_to' => '1',
            'subject' => 'Test Email',
            'content' => 'This is a test email.',
        ];

        $stmt = $this->pdo->prepare("
            INSERT INTO emails (user_from, user_to, subject, content, created_at) 
            VALUES (:user_from, :user_to, :subject, :content, NOW())
        ");
        $stmt->execute($emailData);

        $stmt = $this->pdo->prepare("
            SELECT * FROM emails 
            WHERE user_from = :user_from AND user_to = :user_to AND subject = :subject AND content = :content
        ");
        $stmt->execute([
            'user_from' => '5',
            'user_to' => '1',
            'subject' => 'Test Email',
            'content' => 'This is a test email.'
        ]);
        $email = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($email);
        $this->assertEquals($emailData['user_from'], $email['user_from']);
        $this->assertEquals($emailData['user_to'], $email['user_to']);
        $this->assertEquals($emailData['subject'], $email['subject']);
        $this->assertEquals($emailData['content'], $email['content']);
    }
}
