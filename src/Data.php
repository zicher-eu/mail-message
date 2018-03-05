<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 04.03.2018
 * Time: 21:31
 */

namespace Zicher\MailMessage;

/**
 * Class Data
 * @package Zicher\MailMessage
 */
class Data
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var array
     */
    private $to;

    /**
     * @var array
     */
    private $from;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $bccs = [];

    /**
     * @var array
     */
    private $images = [];

    /**
     * @var array
     */
    private $attachments = [];

    /**
     * @var array
     */
    private $extras = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var string
     */
    private $contentType = 'text/plain';

    /**
     * @param string $index
     * @param mixed $value
     * @return Data
     */
    public function addExtra(string $index, $value): Data
    {
        $this->extras[$index] = $value;

        return $this;
    }

    /**
     * @param string $index
     * @return Data
     */
    public function removeExtra(string $index): Data
    {
        if ($this->hasExtra($index)) {
            unset($this->extras[$index]);
        }

        return $this;
    }

    /**
     * @param string $index
     * @return bool
     */
    public function hasExtra(string $index): bool
    {
        return array_key_exists($index, $this->extras);
    }

    /**
     * @param string $index
     * @param mixed $default
     * @return mixed
     */
    public function getExtra($index, $default = null)
    {
        if ($this->hasExtra($index)) {
            return $this->extras[$index];
        }

        return $default;
    }

    /**
     * @return array
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * @param string $address
     * @param mixed $name
     * @return Data
     */
    public function addBcc(string $address, $name): Data
    {
        $this->bccs[$address] = $name;

        return $this;
    }

    /**
     * @param string $index
     * @return Data
     */
    public function removeBcc(string $index): Data
    {
        if ($this->hasBcc($index)) {
            unset($this->bccs[$index]);
        }

        return $this;
    }

    /**
     * @param string $index
     * @return bool
     */
    public function hasBcc(string $index): bool
    {
        return array_key_exists($index, $this->bccs);
    }

    /**
     * @param string $index
     * @param mixed $default
     * @return mixed
     */
    public function getBcc(string $index, $default)
    {
        if ($this->hasBcc($index)) {
            return $this->bccs[$index];
        }

        return $default;
    }

    /**
     * @return array
     */
    public function getBccs(): array
    {
        return $this->bccs;
    }

    /**
     * @param string $index
     * @param string $path
     * @param string|null $alt
     * @return Data
     */
    public function addImage(string $index, string $path, string $alt = null): Data
    {
        $this->images[$index] = [
            'path' => $path,
            'alt' => $alt,
            'cid' => $this->generateCid($path),
        ];

        $this->data[$index] = [
            'alt' => $alt,
            'cid' => 'cid:' . $this->images[$index]['cid'],
        ];

        return $this;
    }

    /**
     * @param string $string
     * @return string
     */
    protected function generateCid(string $string): string
    {
        return md5($string) . '@' . (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');
    }

    /**
     * @param string $index
     * @return Data
     */
    public function removeImage(string $index): Data
    {
        if ($this->hasImage($index)) {
            unset($this->images[$index]);
        }

        return $this;
    }

    /**
     * @param string $index
     * @return bool
     */
    public function hasImage(string $index): bool
    {
        return array_key_exists($index, $this->images);
    }

    /**
     * @param string $index
     * @param mixed $default
     * @return mixed
     */
    public function getImage(string $index, $default)
    {
        if ($this->hasImage($index)) {
            return $this->images[$index];
        }

        return $default;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param string $index
     * @param string $path
     * @param string|null $name
     * @return Data
     */
    public function addAttachment(string $index, string $path, string $name = null): Data
    {
        $this->attachments[$index] = [
            'path' => $path,
            'name' => $name === null ? basename($path) : $name,
        ];

        return $this;
    }

    /**
     * @param string $index
     * @return Data
     */
    public function removeAttachment(string $index): Data
    {
        if ($this->hasAttachment($index)) {
            unset($this->attachments[$index]);
        }

        return $this;
    }

    /**
     * @param string $index
     * @return bool
     */
    public function hasAttachment(string $index): bool
    {
        return array_key_exists($index, $this->attachments);
    }

    /**
     * @param string $index
     * @param mixed $default
     * @return mixed
     */
    public function getAttachment(string $index, $default)
    {
        if ($this->hasAttachment($index)) {
            return $this->attachments[$index];
        }

        return $default;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return Data
     */
    public function setLocale(string $locale): Data
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Data
     */
    public function setSubject(string $subject): Data
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Data
     */
    public function setBody(string $body): Data
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $contentType
     * @return Data
     */
    public function setContentType(string $contentType): Data
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @return array
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @param string $address
     * @param string|null $name
     * @return Data
     */
    public function setTo(string $address, string $name = null): Data
    {
        $this->to = [
            'name' => $name,
            'address' => $address,
        ];

        return $this;
    }

    /**
     * @return array
     */
    public function getFrom(): array
    {
        return $this->from;
    }

    /**
     * @param string $address
     * @param string|null $name
     * @return Data
     */
    public function setFrom(string $address, string $name = null): Data
    {
        $this->from = [
            'name' => $name,
            'address' => $address,
        ];

        return $this;
    }

    /**
     * @param array $data
     * @return Data
     */
    public function setData(array $data): Data
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}