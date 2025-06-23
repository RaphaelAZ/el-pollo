<?php

namespace App\Controllers;

use App\Enum\DbCollection;
use App\Sys\BaseController;

class OrderController extends BaseController
{

    /**
     * Handles creating a new order and persist it into the DB
     * @return void
     */
    public function newOrder()
    {
        try {
            //$input = $this->getMockedOrder();
            $input = $this->getInputJson();

            //what will be inserted in the DB
            $toInsert = [
                "place" => $input["place"],
                "items" => $input["items"]
            ];

            $orderService = $this->getOrderService();

            $toInsert["total"] = $orderService->calculateOrderTotal($input);

            $toInsert["orderedAt"] = (new \DateTimeImmutable())->getTimestamp();
            $toInsert["uid"] = $orderService->generateOrderId();

            //insert to the db
            $ordersCollection = $this->getDatabaseWrapper()->getCollection(DbCollection::Orders);

            $insertResult = $ordersCollection->insertOne($toInsert);

            if ($insertResult->getInsertedCount() !== 1) {
                throw new \RuntimeException('Unknown error when inserting the new order.');
            }

            $this->respondJson([
                'message' => "Votre commande a bien été prise en compte."
            ], 201);
        } catch (\Throwable $e) {
            $this->respondJson([
                'message' => 'Erreur inconnue lors du traitement de votre commande. Veuillez réessayer.'
            ], 500);
        }
    }
}