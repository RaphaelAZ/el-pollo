<?php

namespace App\Controllers;

use App\Sys\BaseController;

class ConsumablesController extends BaseController
{
    public function getAll()
    {
        $burgerData = $this->getJsonData('burgers.json');
        $drinkData = $this->getJsonData('drinks.json');
        
        $this->respondJson([
            'burgers' => $burgerData,
            'drinks' => $drinkData
        ]);
    }
}