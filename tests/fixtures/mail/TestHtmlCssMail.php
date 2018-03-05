<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 05.03.2018
 * Time: 00:46
 */

/**
 * Class TestHtmlCssMail
 */
class TestHtmlCssMail extends MainMail
{
    /**
     * TestMail constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTo('test.to@zicher.eu', 'Test To')
            ->setSubject('Test subject CSS');

        $this
            ->addExtra('template', 'test.html.twig')
            ->addExtra('styles', 'fixtures/css/base.css');

        $this->setData(array_merge($this->getData(), [
            'test' => 'Test test',
        ]));
    }
}