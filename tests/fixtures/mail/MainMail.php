<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 25.02.2018
 * Time: 22:04
 */

use Zicher\MailMessage\Data;

/**
 * Class MainMail
 */
class MainMail extends Data
{
    /**
     * MainMail constructor.
     */
    public function __construct()
    {
        $this
            ->setFrom('test.from@zicher.eu', 'Test From')
            ->addBcc('test.bcc@zicher.eu', 'Test Bcc');

        $this->setData([
            'title' => 'Test title',
        ]);
    }
}