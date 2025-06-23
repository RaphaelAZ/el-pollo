<?php

namespace App\Services;

use App\Classes\Entity\User;
use App\Enum\DbCollection;
use App\Sys\AppDatabase;
use App\Sys\Config;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\UnencryptedToken;
use MongoDB\Model\BSONDocument;
use Random\RandomException;

readonly class AuthService
{
    public function __construct(
        private Config $config,
        private AppDatabase $database,
    ) {
        //
    }

    /**
     * @throws RandomException
     */
    public function generateToken(array $data, User $user): UnencryptedToken
    {
        $tokenBuilder = Builder::new(new JoseEncoder(), ChainedFormatter::default());
        $algorithm    = new Sha256();
        $signingKey   = InMemory::plainText($this->config->getJwtSecret());

        $now = new \DateTimeImmutable();

        $token = $tokenBuilder
            ->issuedBy('https://back.el-pollo.com')
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now)
            ->expiresAt($now->modify('+2 hours'))
            ->relatedTo((string) $user->getId())
        ;

        foreach ($data as $claimKey => $claimValue) {
            $token->withClaim($claimKey, $claimValue);
        }

        return $token->getToken($algorithm, $signingKey);
    }

    /**
     * Checks if the given credentials are valid and matches a user in the DB
     * @param string $email
     * @param string $password
     * @return BSONDocument|false
     */
    public function checkUserCredentials(string $email, #[\SensitiveParameter] string $password): BSONDocument|false
    {
        $usersCollection = $this->database->getCollection(DbCollection::User);

        /** @var BSONDocument $targetUser */
        $targetUser = $usersCollection->findOne([
            'email' => $email,
        ]);

        if (empty($targetUser)) {
            return false;
        }

        //check the password
        if( !password_verify($password, $targetUser->offsetGet("password")) ) {
            return false;
        }

        //and return the BSON if everything is fine !
        return $targetUser;
    }

    /**
     * Returns true if the provided credentials do not match with anyone
     * @param string $email
     * @param string $username
     * @return bool
     */
    public function isUserUnique(string $email, string $username): bool
    {
        //find all users matching this email or this username
        $usersCollection = $this->database->getCollection(DbCollection::User);

        $allMatchingUsers = $usersCollection->find([
            '$or' => [
                ['email' => $email],
                ['username' => $username]
            ]
        ]);

        return empty($allMatchingUsers->toArray());
    }
}