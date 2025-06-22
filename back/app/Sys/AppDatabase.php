<?php

namespace App\Sys;

use App\Enum\DbCollection;
use MongoDB\Client;
use MongoDB\Database;

/**
 * Singleton of a database connection.
 */
class AppDatabase
{
    private static ?AppDatabase $instance = null;

    private Database $database;

    private function __construct() {
        // ...
    }

    // Prevent cloning & unserialization

    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance(): AppDatabase
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Builds and returns the DSN to connect to the DB
     * @return string
     */
    protected function getDsn(): string
    {
        return sprintf(
            "mongodb://%s:%s@%s:%s/%s?authsource=admin",
            $_ENV["MONGO_USERNAME"],
            $_ENV["MONGO_PASSWORD"],
            $_ENV["MONGO_HOST"],
            $_ENV["MONGO_PORT"],
            $_ENV["MONGO_DB"]
        );
    }

    /**
     * Connects to the DB
     * @return self
     */
    public function connect(): self
    {
        $client = new Client($this->getDsn());

        $this->database = $client->getDatabase($_ENV["MONGO_DB"]);

        return $this;
    }

    /**
     * Returns a given collection
     * @param string|DbCollection $collection
     * @param array $options
     * @return \MongoDB\Collection
     */
    public function getCollection(string|DbCollection $collection, array $options = []): \MongoDB\Collection
    {
        //get the raw collection name
        $finalCollectionName = $collection instanceof DbCollection
            ? $collection->value
            : $collection;

        return $this->database->getCollection($finalCollectionName, $options);
    }

    // ---------------------------------------------------------------

    public function getDatabase(): Database
    {
        return $this->database;
    }
}