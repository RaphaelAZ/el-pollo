<?php

namespace App\Sys;

use App\contracts\SysInitContract;
use App\Controllers\AuthController;
use App\Controllers\BurgerController;
use App\Controllers\ConsumablesController;
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
            $this->lazyRouter->get("/consumables", $this->getRouterString(ConsumablesController::class, 'getAll'));

            $this->lazyRouter->get("/burgers", $this->getRouterString(BurgerController::class, 'getAll'));
            $this->lazyRouter->get("/burgers/{id}", $this->getRouterString(BurgerController::class, 'getSingle'));

            $this->lazyRouter->post("/login", $this->getRouterString(AuthController::class, 'login'));
            $this->lazyRouter->post("/register", $this->getRouterString(AuthController::class, 'register'));
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