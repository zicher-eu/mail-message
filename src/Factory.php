<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 04.03.2018
 * Time: 23:37
 */

namespace Zicher\MailMessage;

use Zicher\MailMessage\Message\MessageInterface;
use Zicher\MailMessage\Processor\ProcessorInterface;

/**
 * Class Factory
 * @package Zicher\MailMessage
 */
class Factory
{
    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @var ProcessorInterface[]
     */
    private $processors = [];

    /**
     * Factory constructor.
     * @param MessageInterface $message
     * @param array $processors
     */
    public function __construct(MessageInterface $message, array $processors = [])
    {
        $this->message = $message;

        foreach ($processors as $processor) {
            if (false === ($processor instanceof ProcessorInterface)) {
                throw new \InvalidArgumentException(sprintf('Given processor is not instance of ProcessorInterface, "%s" given', gettype($processor)));
            }
        }

        $this->processors = $processors;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function factory(Data $data)
    {
        foreach ($data->getImages() as $imageIndex => $imageData) {
            $this->message->addImage($imageData['path'], $imageData['cid']);
        }

        foreach ($data->getAttachments() as $fileIndex => $fileData) {
            $this->message->addAttachment($fileData['path'], $fileData['name']);
        }

        foreach ($this->processors as $processor) {
            $data = $processor->process($data);
        }

        $this
            ->message
            ->setTo($data->getTo())
            ->setFrom($data->getFrom())
            ->setSubject($data->getSubject())
            ->setBody($data->getBody())
            ->setContentType($data->getContentType());

        return $this->message->getMessage();
    }
}