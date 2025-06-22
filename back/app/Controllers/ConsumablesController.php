<?php

namespace App\Controllers;

use App\Enum\DbCollection;
use App\Sys\BaseController;

class ConsumablesController extends BaseController
{
    public function getAll()
    {
        try {
            $databaseWrapper = $this->getDatabaseWrapper();

            //get all burgers, drinks and ingredients
            $burgersCollection = $databaseWrapper->getCollection(DbCollection::Burgers);
            $allBurgersRaw = $burgersCollection->find();

            $drinksCollection = $databaseWrapper->getCollection(DbCollection::Drinks);
            $allDrinksRaw = $drinksCollection->find();

            $ingredientsCollection = $databaseWrapper->getCollection(DbCollection::Ingredients);
            $allIngredientsRaw = $ingredientsCollection->find();

            $entityHelper = $this->getEntityHelper();

            //convert the safe array to a front-end-friendy schema
            $safeIngredientsArray = $entityHelper->ingredientBsonCollectionToSafeArray($allIngredientsRaw);

            //and convert them all to a safe array (just primitive types)
            $this->respondJson([
                'burgers' => $entityHelper->burgerBsonCollectionToSafeArray($allBurgersRaw),
                'drinks' => $entityHelper->drinkBsonCollectionToSafeArray($allDrinksRaw),
                'ingredients' => $entityHelper->convertIngredientsArrayToSimpleArray($safeIngredientsArray)
            ]);

        } catch (\Throwable $e) {
            $this->respondJson([
                "message" => "Erreur inconnue lors de la récupération de tous nos consommables. Veuillez réessayer."
            ]);
        }
    }
}