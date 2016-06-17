<?php
/**
 * Created by PhpStorm.
 * User: marcel
 * Date: 15.04.16
 * Time: 21:42
 */
namespace Beatheat\RequestURL;

class RequestURL
{
    private $url;
    private $action;
    private $parameters;

    /**
     * RequestURL constructor.
     * @param string $url
     */
    private

    /**
     * RequestURL constructor.
     */
    function __construct ($url)
    {
        $this->url = $url;
        $this->parameters = $this->parseURLParametersToArray ($url);
    }

    private function parseURLParametersToArray ($url)
    {
        
    }
}