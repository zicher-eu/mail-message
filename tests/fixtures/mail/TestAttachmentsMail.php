<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 05.03.2018
 * Time: 14:50
 */

/**
 * Class TestAttachmentsMail
 */
class TestAttachmentsMail extends MainMail
{
    /**
     * TestAttachmentsMail constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTo('test.to@zicher.eu', 'Test To')
            ->setSubject('Test subject attachments')
            ->setBody('Test body');

        $this
            ->addAttachment('attachmentTest1', 'tests/fixtures/images/test1.png')
            ->addAttachment('attachmentTest2', 'tests/fixtures/images/test2.png', 'Test 2.png');
    }
}