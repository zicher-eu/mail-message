<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 05.03.2018
 * Time: 00:34
 */

/**
 * Class TestMail
 */
class TestSimpleMail extends MainMail
{
    /**
     * TestMail constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTo('test.to@zicher.eu', 'Test To')
            ->setSubject('Test subject')
            ->setBody('Test body');
    }
}