<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kotlarek (ZICHER)
 * Date: 05.03.2018
 * Time: 01:07
 */

namespace Zicher\MailMessage\Processor;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Zicher\MailMessage\Data;

/**
 * Class CssInline
 * @package Zicher\MailMessage\Processor
 */
class CssInlineProcessor implements ProcessorInterface
{
    /**
     * @var CssToInlineStyles
     */
    private $cssToInlineStyles;

    /**
     * CssInline constructor.
     * @param CssToInlineStyles $cssToInlineStyles
     */
    public function __construct(CssToInlineStyles $cssToInlineStyles)
    {
        $this->cssToInlineStyles = $cssToInlineStyles;
    }

    /**
     * @param Data $data
     * @return Data
     */
    public function process(Data $data): Data
    {
        $data
            ->setBody($this->cssToInlineStyles->convert(
                $data->getBody(),
                file_get_contents($data->getExtra('styles'))
            ));

        return $data;
    }
}