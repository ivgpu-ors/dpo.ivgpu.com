<?php


namespace App\Ivgpu\Services;


use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use UnexpectedValueException;

class JwtService
{
    private string $public_key;

    /**
     * JwtService constructor.
     * @param string $public_key
     */
    public function __construct(string $public_key)
    {
        $this->public_key = $public_key;
    }

    /**
     * @param string $token
     * @throws UnexpectedValueException     Provided JWT was invalid
     * @throws SignatureInvalidException    Provided JWT was invalid because the signature verification failed
     * @throws BeforeValidException         Provided JWT is trying to be used before it's eligible as defined by 'nbf'
     * @throws BeforeValidException         Provided JWT is trying to be used before it's been created as defined by 'iat'
     * @throws ExpiredException             Provided JWT has since expired, as defined by the 'exp' claim
     * @return array
     */
    public function decode(string $token): array
    {
        return (array) JWT::decode($token, $this->public_key, ['RS256']);
    }
}
