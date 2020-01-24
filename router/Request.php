<?php

namespace Router;

class Request
{
    // class constructor
    function __construct()
    {
        $this->attributes();
    }

    private function attributes()
    {
        // asign all $_SERVER attributes to class instance
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    // parse string value to camelcase
    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }
}