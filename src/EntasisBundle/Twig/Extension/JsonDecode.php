<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.01.18
 * Time: 13:27
 */

namespace EntasisBundle\Twig\Extension;


class JsonDecode extends \Twig_Extension
{
    public function getName()
    {
        return 'twig.json_decode';
    }

    public function getFilters()
    {
        return [
            'json_decode' => new \Twig_Filter_Method($this, 'jsonDecode')
        ];
    }

    public function jsonDecode($string)
    {
        return json_decode($string);
    }
}