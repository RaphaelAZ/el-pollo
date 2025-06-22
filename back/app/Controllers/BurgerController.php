<?php

namespace App\Controllers;

use App\Enum\DbCollection;
use App\Sys\BaseController;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

class BurgerController extends BaseController
{
    public function getAll()
    {
        try {
            $burgersCollection = $this->getDatabaseWrapper()->getCollection(DbCollection::Burgers);
            $allBurgers = $burgersCollection->find();

            $this->respondJson(
                $this->getEntityHelper()->burgerBsonCollectionToSafeArray($allBurgers)
            );
        } catch (\Throwable $e) {
            $this->respondJson([
                "message" => "Erreur inconnue lors de la récupération de tous nos burgers."
            ], 500);
        }

    }

    public function getSingle(string $id)
    {
        try {
            $burgersCollection = $this->getDatabaseWrapper()->getCollection(DbCollection::Burgers);

            /** @var BSONDocument $targetBurger */
            $targetBurger = $burgersCollection->findOne([
                '_id' => new ObjectId($id)
            ]);

            if( empty($targetBurger) ) {
                $this->respond404();
            }

            $this->respondJson(
                $this->getEntityHelper()->burgerBsonToSafeArray($targetBurger)
            );
        } catch (\Throwable $e) {
            $this->respondJson([
                "message" => "Erreur inconnue lors de la récupération de votre burger."
            ], 500);
        }

    }
}