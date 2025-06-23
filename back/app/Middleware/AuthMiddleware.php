<?php

namespace App\Middleware;

use App\Contracts\MiddlewareContract;
use App\Enum\DbCollection;
use App\Sys\BaseController;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;
use Lcobucci\Clock\SystemClock;
use MongoDB\BSON\ObjectId;

class AuthMiddleware extends BaseController implements MiddlewareContract
{
    public function __invoke()
    {
        try {
            $tokenString = $this->getTokenFromRequest();

            $token = $this->checkTokenValidity($tokenString);

            //check if the user exists
            $userId = $token->claims()->get('sub');

            $userCollection = $this->getDatabaseWrapper()->getCollection(DbCollection::User);
            $targetUser = $userCollection->findOne([
                "_id" => new ObjectId($userId)
            ]);

            if( empty($targetUser) ) {
                $this->respondOnlyCode(401);
            }

        } catch (\Throwable $e) {
            $this->respondOnlyCode(500);
        }
    }

    /**
     * @return string|null
     */
    protected function getTokenFromRequest(): string|null
    {
        //get the token from the request
        $tokenString = $_SERVER['HTTP_AUTHORIZATION'] ?? ''; // "Bearer <token>"

        if( empty($tokenString) ) {
            $this->respondOnlyCode(401);
        }

        // Remove "Bearer " prefix
        return preg_replace('/^Bearer\s+/', '', $tokenString);
    }

    /**
     * @param string $tokenString
     * @return UnencryptedToken
     * @throws \Exception
     */
    protected function checkTokenValidity(string $tokenString): UnencryptedToken
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText($this->getConfig()->getJwtSecret())
        );

        //parse the data
        $token = $config->parser()->parse($tokenString);

        assert($token instanceof UnencryptedToken);

        $constraints = [
            new SignedWith($config->signer(), $config->verificationKey()),
            new IssuedBy('https://back.el-pollo.com'),
            new StrictValidAt(SystemClock::fromUTC())
        ];

        $constraintsValid = $config->validator()->validate($token, ...$constraints);

        if (!$constraintsValid) {
            throw new \Exception('Token failed validation');
        }

        return $token;
    }
}