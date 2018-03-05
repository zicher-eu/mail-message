<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 05.03.2018
 * Time: 11:30
 */

/**
 * Class TestHtmlEmbeddedImageMail
 */
class TestHtmlEmbeddedImagesMail extends MainMail
{
    /**
     * TestHtmlEmbeddedImageMail constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTo('test.to@zicher.eu', 'Test To')
            ->setSubject('Test subject HTML and IMAGES');

        $this->addExtra('template', 'test.html.twig');

        $this
            ->addImage('imageTest1', 'fixtures/images/test1.png')
            ->addImage('imageTest2', 'fixtures/images/test2.png', 'Alternate text test');
    }
}