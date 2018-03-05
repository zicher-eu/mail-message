<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 05.03.2018
 * Time: 00:47
 */

namespace Zicher\MailMessage\Processor;
use Zicher\MailMessage\Data;

/**
 * Class TwigRendererProcessor
 * @package Zicher\MailMessage\Processor
 */
class TwigRendererProcessor implements ProcessorInterface
{
    /**
     * @var \Twig_Environment
     */
    private $renderer;

    /**
     * TwigRendererProcessor constructor.
     * @param \Twig_Environment $renderer
     */
    public function __construct(\Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param Data $data
     * @return Data
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function process(Data $data): Data
    {
        $data
            ->setBody($this->renderer->render($data->getExtra('template'), $data->getData()))
            ->setContentType('text/html');

        return $data;
    }
}