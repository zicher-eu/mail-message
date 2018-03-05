<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 04.03.2018
 * Time: 23:39
 */

namespace Zicher\MailMessage\Message;

/**
 * Class MessageInterface
 * @package Zicher\MailMessage\Message
 */
interface MessageInterface
{
    /**
     * @return mixed
     */
    public function getMessage();

    /**
     * @param array $to
     * @return MessageInterface
     */
    public function setTo(array $to): MessageInterface;

    /**
     * @param array $from
     * @return MessageInterface
     */
    public function setFrom(array $from): MessageInterface;

    /**
     * @param string $subject
     * @return MessageInterface
     */
    public function setSubject(string $subject): MessageInterface;

    /**
     * @param string $body
     * @return MessageInterface
     */
    public function setBody(string $body): MessageInterface;

    /**
     * @param string $contentType
     * @return MessageInterface
     */
    public function setContentType(string $contentType): MessageInterface;

    /**
     * @param string $imagePath
     * @param string $cid
     * @return MessageInterface
     */
    public function addImage(string $imagePath, string $cid): MessageInterface;

    /**
     * @param string $filePath
     * @param string|null $name
     * @return MessageInterface
     */
    public function addAttachment(string $filePath, string $name = null): MessageInterface;
}