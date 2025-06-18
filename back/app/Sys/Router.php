<?php

namespace App\Sys;

use App\contracts\SysInitContract;
use App\Controllers\TestController;
use \Bramus\Router\Router as WrappedRouter;

class Router implements SysInitContract
{
    private WrappedRouter $lazyRouter;

    public function init(): void
    {
        $this->lazyRouter = new WrappedRouter();
    }

    public function defineRoutes(): void
    {
        $this->lazyRouter->mount("/api", function () {
            $this->lazyRouter->get('john', $this->getRouterString(TestController::class, 'hello'));
        });

        $this->lazyRouter->run();
    }

    /**
     * Return the controller name and method for a router route
     * @param string $controller
     * @param string $methodName
     * @return string
     */
    private function getRouterString(string $controller, string $methodName): string
    {
        return sprintf("%s@%s", $controller, $methodName);
    }
}