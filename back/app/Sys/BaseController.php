<?php

namespace App\Sys;

use App\Classes\Entity\User;
use App\Enum\DbCollection;
use App\Services\AuthService;
use App\Services\EntityService;
use App\Services\OrderService;
use JetBrains\PhpStorm\NoReturn;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

class BaseController
{
    private AppDatabase $database;

    private EntityService $entityHelper;

    private AuthService $authService;

    private OrderService $orderService;

    private Config $config;

    public function __construct()
    {
        //config
        $this->config = new Config();

        //connect to database
        $this->database = AppDatabase::getInstance();
        $this->database->connect();

        //services and helpers
        $this->entityHelper = new EntityService();
        $this->authService = new AuthService($this->config, $this->database);
        $this->orderService = new OrderService();
    }


    #[NoReturn]
    protected function respondJson(mixed $data, int $code = 200): void
    {
        $this->setGenericHeaders($code);
        header('Content-Type: application/json');

        echo json_encode($data);

        exit(0);
    }

    protected function setGenericHeaders(?int $responseCode = 200): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Expires: 0');
        header('Pragma: no-cache');

        if( null !== $responseCode ) {
            http_response_code($responseCode);
        }
    }

    #[NoReturn]
    protected function respond404(): void
    {
        $this->setGenericHeaders(404);
        exit(0);
    }

    #[NoReturn]
    protected function respondOnlyCode(int $code)
    {
        $this->setGenericHeaders($code);
        exit(0);
    }

    /**
     * @param array $users
     * @return User[]
     */
    protected function hydrateUsers(array $users): array
    {
        return array_map(function ($singleUser) {
            return User::fromJson($singleUser);
        }, $users);
    }

    /**
     * Parses the raw PHP input buffer into an array (only if the buffer is a json string)
     * @throws \JsonException
     */
    protected function getInputJson(): array
    {
        return json_decode(
            file_get_contents('php://input'),
            true,
            flags: JSON_THROW_ON_ERROR
        );
    }

    protected function getTokenStringFromRequest()
    {
        //get the token from the request
        $tokenString = $_SERVER['HTTP_AUTHORIZATION'] ?? ''; // "Bearer <token>"

        if( empty($tokenString) ) {
            $this->respondOnlyCode(401);
        }

        // Remove "Bearer " prefix
        return preg_replace('/^Bearer\s+/', '', $tokenString);
    }

    protected function getTokenObjectFromString(string $tokenString): Token
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText($this->getConfig()->getJwtSecret())
        );

        //parse the data
        return $config->parser()->parse($tokenString);
    }

    /**
     * Combines ``getTokenStringFromRequest```and ``getTokenObjectFromString``
     * @return Token|null
     */
    protected function decodeJwtToken(): ?Token
    {
        $rawToken = $this->getTokenStringFromRequest();

        if( empty($rawToken) ) {
            return null;
        }

        return $this->getTokenObjectFromString($rawToken);
    }

    /**
     * @return User|null
     */
    protected function getCurrentUser(): User|null
    {
        $token = $this->decodeJwtToken();

        if( empty($token) ) {
            return null;
        }

        $userId = new ObjectId($token->claims()->get('sub'));

        $userCollection = $this->getDatabaseWrapper()->getCollection(DbCollection::User);
        $targetUser = $userCollection->findOne([
            "_id" => $userId
        ]);

        if( empty($targetUser) ) {
            return null;
        }

        if( is_array($targetUser) ) {
            return User::fromJson($targetUser);
        } else {
            return User::fromBson($targetUser);
        }
    }

    // --------------------------------------------------------------------------------------------

    public function getDatabaseWrapper(): AppDatabase
    {
        return $this->database;
    }

    protected function getConfig(): Config
    {
        return $this->config;
    }

    public function getEntityHelper(): EntityService
    {
        return $this->entityHelper;
    }

    public function getAuthService(): AuthService
    {
        return $this->authService;
    }

    public function getOrderService(): OrderService
    {
        return $this->orderService;
    }
}