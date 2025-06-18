<?php

namespace App\Sys;

use App\Contracts\SysInitContract;
use Symfony\Component\VarDumper\VarDumper;

class App implements SysInitContract
{
    private Router $router;


    public function init()
    {
        $this
            ->initRouter()
            //->initVarDumper()
        ;
    }

    protected function initRouter(): self
    {
        $this->router = new Router();
        $this->router->init();
        $this->router->defineRoutes();

        return $this;
    }

    protected function initVarDumper(): self
    {
        VarDumper::setHandler(function ($var) {
            echo json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
        });

        return $this;
    }


}