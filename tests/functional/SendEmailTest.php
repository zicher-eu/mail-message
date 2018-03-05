<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 28.02.2018
 * Time: 14:31
 */

use PHPUnit\Framework\TestCase;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Zicher\MailMessage\Factory;
use Zicher\MailMessage\Message\SwiftMessage;
use Zicher\MailMessage\Processor\CssInlineProcessor;
use Zicher\MailMessage\Processor\TwigRendererProcessor;

/**
 * Class SendEmailTest
 */
class SendEmailTest extends TestCase
{
    /**
     * @var \Swift_Mailer
     */
    private static $mailer;

    /**
     *
     */
    public static function setUpBeforeClass()
    {
        $transport = new \Swift_SmtpTransport('127.0.0.1', 4925);
        self::$mailer = new \Swift_Mailer($transport);
    }

    /**
     *
     */
    public function testSendSimpleEmail()
    {
        $factory = new Factory(new SwiftMessage(new \Swift_Message()));

        /** @var \Swift_Message $message */
        $message = $factory->factory(new TestSimpleMail());
        $this->assertContains('Test body', $message->getBody());

        $result = self::$mailer->send($message);
        $this->assertGreaterThan(0, $result);
    }

    /**
     *
     */
    public function testSendHtmlEmail()
    {
        $factory = new Factory(new SwiftMessage(new \Swift_Message()), [
            new TwigRendererProcessor(new \Twig_Environment(new \Twig_Loader_Filesystem('fixtures/templates'), [
                'cache' => false,
            ])),
        ]);

        /** @var \Swift_Message $message */
        $message = $factory->factory(new TestHtmlMail());
        $this->assertContains('</html>', $message->getBody());

        $result = self::$mailer->send($message);
        $this->assertGreaterThan(0, $result);
    }

    /**
     *
     */
    public function testSendHtmlCssInlineEmail()
    {
        $factory = new Factory(new SwiftMessage(new \Swift_Message()), [
            new TwigRendererProcessor(new \Twig_Environment(new \Twig_Loader_Filesystem('fixtures/templates'), [
                'cache' => false,
            ])),
            new CssInlineProcessor(new CssToInlineStyles()),
        ]);

        /** @var \Swift_Message $message */
        $message = $factory->factory(new TestHtmlCssMail());
        $this->assertContains('style="', $message->getBody());

        $result = self::$mailer->send($message);
        $this->assertGreaterThan(0, $result);
    }

    /**
     *
     */
    public function testSendHtmlEmbeddedImagesEmail()
    {
        $factory = new Factory(new SwiftMessage(new \Swift_Message()), [
            new TwigRendererProcessor(new \Twig_Environment(new \Twig_Loader_Filesystem('fixtures/templates'), [
                'cache' => false,
            ])),
        ]);

        /** @var \Swift_Message $message */
        $message = $factory->factory(new TestHtmlEmbeddedImagesMail());
        $this->assertContains('src="cid:e7f0f504a8f8df443ce3acf740c2c829', $message->getBody());
        $this->assertContains('alt="Alternate text test"', $message->getBody());

        $result = self::$mailer->send($message);
        $this->assertGreaterThan(0, $result);
    }

    /**
     *
     */
    public function testSendAttachmentsEmail()
    {
        $factory = new Factory(new SwiftMessage(new \Swift_Message()));

        /** @var \Swift_Message $message */
        $message = $factory->factory(new TestAttachmentsMail());

        $stringified = $message->toString();
        $this->assertContains('Content-Disposition: attachment; filename=test1.png', $stringified);
        $this->assertContains('Content-Disposition: attachment; filename="Test 2.png"', $stringified);

        $result = self::$mailer->send($message);
        $this->assertGreaterThan(0, $result);
    }
}