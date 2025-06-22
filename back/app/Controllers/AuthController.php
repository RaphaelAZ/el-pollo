<?php

namespace App\Controllers;

use App\Classes\Data\LoginPostData;
use App\Classes\Data\RegisterPostData;
use App\Classes\Entity\User;
use App\Sys\BaseController;
use App\Sys\Config;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\UnencryptedToken;
use Random\RandomException;

class AuthController extends BaseController
{
    private readonly Config $config;

    public function __construct()
    {
        $this->config = new Config();

        $this->createDataFileIfNotExists(  $this->config->getUsersFileName(), "[]");
    }

    /**
     * FIXME: POST and GET variables are not taken by PHP ?
     * Attempts to log in in the user
     * @return void
     * @throws RandomException
     * @throws \JsonException
     */
    public function login()
    {
        try {
            $jsonData = $this->getInputJson();

            if (empty($jsonData["email"]) || empty($jsonData["password"])) {
                $this->respondJson([
                    'message' => 'Veuillez préciser un mot de passe ou un email'
                ], 400);
            }

            $postData = new LoginPostData($jsonData['email'], $jsonData['password']);

            $allUsers = $this->getJsonData($this->config->getUsersFileName());

            $hydratedUsers = $this->hydrateUsers($allUsers);

            //take the matching user via email and password
            /** @var User[] $allMatchingUsers */
            $allMatchingUsers = array_filter($hydratedUsers, function ($singleUser) use ($postData) {
                return $singleUser->getEmail() === $postData->email && $singleUser->getPassword() === $postData->password;
            });

            if (empty($allMatchingUsers)) {
                $this->respondJson([
                    'message' => "Email ou MDP invalide."
                ], 401);
            }

            $targetUser = array_shift($allMatchingUsers);

            //sign the JWT token
            $token = $this->generateToken([
                'user' => $targetUser->toArray(),
            ]);

            //return the token
            $this->respondJson([
                'token' => $token->toString(),
                'user' => [
                    'email' => $targetUser->getEmail(),
                    'username' => $targetUser->getUsername()
                ]
            ], 200);
        } catch (\Throwable $e) {
            $this->respondJson([
                "message" => "Erreur inconnue lors de votre connexion"
            ], 500);
        }
    }

    /**
     * @throws RandomException
     */
    private function generateToken(array $data): UnencryptedToken
    {
        $tokenBuilder = Builder::new(new JoseEncoder(), ChainedFormatter::default());
        $algorithm    = new Sha256();
        $signingKey   = InMemory::plainText($this->config->getJwtSecret());

        $now = new \DateTimeImmutable();

        $token = $tokenBuilder
            ->issuedBy('https://back.el-pollo.com')
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now->modify('+1 hour'));

        foreach ($data as $claimKey => $claimValue) {
            $token->withClaim($claimKey, $claimValue);
        }

        return $token->getToken($algorithm, $signingKey);
    }

    /**
     * FIXME: POST and GET variables are not taken by PHP ?
     * @return void
     */
    public function register()
    {
        try {
            $jsonData = $this->getInputJson();

            if ( empty($jsonData['email']) || empty($jsonData['username']) || empty($jsonData['password']) ) {
                $this->respondJson([
                    'message' => "Veuillez préciser un mot de passe, un email et nom d'utilisateur"
                ], 400);
            }

            $postData = new RegisterPostData(
                $jsonData['email'],
                $jsonData['password'],
                $jsonData['username']
            );

            $allUsers = $this->getJsonData($this->getConfig()->getUsersFileName());
            $hydratedUsers = $this->hydrateUsers($allUsers);

            //check if any user has the same password or username
            /** @var User[] $allMatchingUsers */
            $allMatchingUsers = array_filter($hydratedUsers, function ($singleUser) use ($postData) {
                return $singleUser->getEmail() === $postData->email || $singleUser->getUsername() === $postData->username;
            });

            if (!empty($allMatchingUsers)) {
                $this->respondJson([
                    'message' => "Cet utilisateur existe déjà."
                ], 409);
            }

            //mise des données dans le json
            $insertedUser = new User($postData->email, $postData->password, $postData->username);
            $allUsers[] = $insertedUser->toArray();

            $this->dumpDataFile($this->config->getUsersFileName(), $allUsers);

            $this->respondJson([
                'message' => "Utilisateur créé"
            ], 201);
        } catch (\Throwable $e) {
            $this->respondJson([
                "message" => "Erreur inconnue lors de l'inscription"
            ], 500);
        }
    }
}