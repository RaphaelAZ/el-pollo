<?php

namespace App\Controllers;

use App\Sys\BaseController;

class BurgerController extends BaseController
{
    public function getAll()
    {
        $data = $this->getJsonData('burgers.json');

        $this->respondJson($data);
    }

    public function getSingle(int $id)
    {
        $data = $this->getJsonData('burgers.json');

        $targetBurger = array_filter($data, fn($singleBurger) => $singleBurger["id"] === $id);

        if( empty($targetBurger) ) {
            $this->respond404();
        }

        $this->respondJson(
            array_shift($targetBurger)
        );
    }
}