<?php

namespace App\Services;

use App\Classes\Entity\User;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\CursorInterface;
use MongoDB\Model\BSONDocument;

class EntityService
{
    /**
     * Converts a single burger BSON to a response-safe array (no custom objects)
     * @param BSONDocument $burger
     * @return array
     */
    public function burgerBsonToSafeArray(BSONDocument $burger): array
    {
        $rawArrayData = $this->commonConvert($burger);

        //convert the ingredients into strings
        $rawArrayData["ingredients"] = (array) $rawArrayData['ingredients'];

        return $rawArrayData;
    }

    /**
     * @param CursorInterface $burgers
     * @return array
     */
    public function burgerBsonCollectionToSafeArray(CursorInterface $burgers): array
    {
        $data = [];

        foreach ($burgers as $burger) {
            $data[] = $this->burgerBsonToSafeArray($burger);
        }

        return $data;
    }

    public function commonConvert(BSONDocument $document)
    {
        $rawData = (array) $document;

        $this->ObjectIdToStringId($rawData);

        return $rawData;
    }

    public function drinkBsonToSafeArray(BSONDocument $drink): array
    {
        return $this->commonConvert($drink);
    }

    /**
     * @param CursorInterface $drinks
     * @return array
     */
    public function drinkBsonCollectionToSafeArray(CursorInterface $drinks): array
    {
        $data = [];

        foreach ($drinks as $drink) {
            $data[] = $this->commonConvert($drink);
        }

        return $data;
    }

    public function ingredientBsonToSafeArray(BSONDocument $ingredient): array
    {
        $rawData = $this->commonConvert($ingredient);

        //convert the ingredients into strings
        $rawData["ingredients"] = (array) $rawData['ingredients'];

        return $rawData;
    }

    public function ingredientBsonCollectionToSafeArray(CursorInterface $ingredients): array
    {
        $data = [];

        foreach ($ingredients as $ingredient) {
            $data[] = $this->ingredientBsonToSafeArray($ingredient);
        }

        return $data;
    }

    public function ObjectIdToStringId(array &$data): void
    {
        //convert the object ID into a string ID
        $data["id"] = (string) $data['_id'];
        unset($data['_id']);
    }

    /**
     * Converts the given array of ingredients into a front-end-friendly schema
     * @param array[] $ingredients
     * @return Array<string, string[]>
     */
    public function convertIngredientsArrayToSimpleArray(array $ingredients): array
    {
        /** @var Array<string, string[]> $data key is the category of the ingredient, value is an array of all ingredients */
        $data = [];

        foreach ($ingredients as $singleIngredient) {
            $data[ $singleIngredient["type"] ] = $singleIngredient["ingredients"];
        }

        return $data;
    }

    /**
     * Converts a User document into a PHP-safe array.
     * @param BSONDocument $user
     * @param bool $withPassword
     * @return array
     */
    public function userBsonToSafeUserArray(BSONDocument $user, bool $withPassword = false)
    {
        $rawData = $this->commonConvert($user);

        if( !$withPassword ) {
            unset($rawData['password']);
        }

        return $rawData;
    }

    public function userBsonToUserEntity(BSONDocument $user): User
    {
        return new User(
            $user->offsetGet('email'),
            $user->offsetGet('password'),
            $user->offsetGet('username'),
            $user->offsetGet('_id'),
        );
    }
}