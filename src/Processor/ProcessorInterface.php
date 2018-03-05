<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 04.03.2018
 * Time: 21:31
 */

namespace Zicher\MailMessage\Processor;

use Zicher\MailMessage\Data;

/**
 * Interface ProcessorInterface
 * @package Zicher\MailMessage\Processor
 */
interface ProcessorInterface
{
    /**
     * @param Data $data
     * @return Data
     */
    public function process(Data $data): Data;
}