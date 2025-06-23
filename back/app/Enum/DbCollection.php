<?php

namespace App\Enum;

/**
 * Enum that holds collections names for the DB
 */
enum DbCollection: string
{
    case Burgers = "burgers";
    case Drinks = "drinks";
    case Ingredients = "ingredients";
    case Orders = "orders";
    case User = "user";
}
