<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 04.03.2018
 * Time: 23:40
 */

namespace Zicher\MailMessage\Message;

/**
 * Class SwiftMessage
 * @package Zicher\MailMessage\Message
 */
class SwiftMessage implements MessageInterface
{
    /**
     * @var \Swift_Message
     */
    private $swiftMessage;

    /**
     * SwiftMessage constructor.
     * @param \Swift_Message $swiftMessage
     */
    public function __construct(\Swift_Message $swiftMessage)
    {
        $this->swiftMessage = $swiftMessage;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->swiftMessage;
    }

    /**
     * @param array $to
     * @return MessageInterface
     */
    public function setTo(array $to): MessageInterface
    {
        $this->swiftMessage->setTo([
            $to['address'] => $to['name'],
        ]);

        return $this;
    }

    /**
     * @param array $from
     * @return MessageInterface
     */
    public function setFrom(array $from): MessageInterface
    {
        $this->swiftMessage->setFrom([
            $from['address'] => $from['name'],
        ]);

        return $this;
    }

    /**
     * @param string $subject
     * @return MessageInterface
     */
    public function setSubject(string $subject): MessageInterface
    {
        $this->swiftMessage->setSubject($subject);

        return $this;
    }

    /**
     * @param string $body
     * @return MessageInterface
     */
    public function setBody(string $body): MessageInterface
    {
        $this->swiftMessage->setBody($body);

        return $this;
    }

    /**
     * @param string $contentType
     * @return MessageInterface
     */
    public function setContentType(string $contentType): MessageInterface
    {
        $this->swiftMessage->setContentType($contentType);

        return $this;
    }

    /**
     * @param string $imagePath
     * @param string $cid
     * @return MessageInterface
     * @throws \Swift_IoException
     */
    public function addImage(string $imagePath, string $cid): MessageInterface
    {
        $image = new \Swift_Image();
        $image
            ->setFile(new \Swift_ByteStream_FileByteStream($imagePath))
            ->setId($cid);

        $this->swiftMessage->embed($image);

        return $this;
    }

    /**
     * @param string $filePath
     * @param string|null $name
     * @return MessageInterface
     * @throws \Swift_IoException
     */
    public function addAttachment(string $filePath, string $name = null): MessageInterface
    {
        $file = new \Swift_Attachment();
        $file->setFile(new \Swift_ByteStream_FileByteStream($filePath));

        if (null !== $name) {
            $file->setFilename($name);
        }

        $this->swiftMessage->attach($file);

        return $this;
    }
}