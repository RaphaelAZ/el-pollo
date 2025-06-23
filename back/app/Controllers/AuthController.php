<?php

namespace App\Controllers;

use App\Enum\DbCollection;
use App\Sys\BaseController;
use App\Sys\Config;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\UnencryptedToken;
use MongoDB\Model\BSONDocument;
use Random\RandomException;

class AuthController extends BaseController
{
    /**
     * Attempts to log in in the user
     * @return void
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

            $authService = $this->getAuthService();

            $targetUserDocument = $authService->checkUserCredentials($jsonData['email'], $jsonData['password']);

            //if the credentials are wrong
            if( !$targetUserDocument instanceof BSONDocument ) {
                $this->respondJson([
                    'message' => "Email ou mot de passe incorrect."
                ], 403);
            }

            //convert to entity
            $targetUser = $this->getEntityHelper()->userBsonToUserEntity($targetUserDocument);

            //generate a JWT token
            $token = $authService->generateToken([
                'user' => $targetUser->toArray(),
            ], $targetUser);

            //return the token and the user data
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

            $authService = $this->getAuthService();

            if ( !$authService->isUserUnique($jsonData['email'], $jsonData['username']) ) {
                $this->respondJson([
                    'message' => "Cet utilisateur existe déjà."
                ], 409);
            }

            $usersCollection = $this->getDatabaseWrapper()->getCollection(DbCollection::User);

            //insertion des données dans la collection
            $insertResult = $usersCollection->insertOne([
                'email' => $jsonData['email'],
                'username' => $jsonData['username'],
                'password' => password_hash( $jsonData['password'], $this->getConfig()->getPasswordHashAlgo() )
            ]);

            if( $insertResult->getInsertedCount() !== 1 ) {
                throw new \RuntimeException('Unknown error when inserting the new user.');
            }

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