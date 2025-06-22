<?php

namespace App\Contracts;

use MongoDB\Model\BSONDocument;

interface FromDatabaseContract
{
    public static function fromBSON(BSONDocument $document): self;
}