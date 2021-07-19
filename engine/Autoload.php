<?php

namespace app\engine;

spl_autoload_register([new Autoload($config), 'loadClass']);

class Autoload
{

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }


    public function loadClass($className)
    {
        $fileName = realpath(str_replace(['app', '\\'], [$this->config['root_dir'], $this->config['ds']], $className) . ".php");

        if (file_exists($fileName)) {
            include $fileName;

        }


    }

}