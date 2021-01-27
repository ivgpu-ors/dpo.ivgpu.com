<?php


namespace App\Ivgpu\Services;


use App\Ivgpu\Exceptions\InvalidTokenException;
use App\Ivgpu\Interfaces\TokenProvider;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Support\Facades\Log;
use UnexpectedValueException;

class TokenService
{
    protected TokenProvider $provider;
    protected JwtService $jwt;
    protected ApiService $api;

    /**
     * TokenService constructor.
     * @param TokenProvider $provider
     * @param JwtService $jwt
     * @param ApiService $api
     */
    public function __construct(TokenProvider $provider, JwtService $jwt, ApiService $api)
    {
        $this->provider = $provider;
        $this->jwt = $jwt;
        $this->api = $api;
    }

    public function getUserData(): ?array
    {
        if (!$this->provider->hasToken()) {
            return null;
        }

        $token = $this->provider->getToken();
        return $this->decodeToken($token);
    }

    /**
     * @param string $token
     * @return array|null
     */
    private function decodeToken(string $token): ?array
    {
        try {
            return $this->jwt->decode($token);
        }
        catch(ExpiredException $e)
        {
            $new_token = $this->api->refreshToken($token);
            return $new_token ? $this->decodeToken($new_token) : null;
        }
        catch (BeforeValidException $e)
        {
            Log::error('JWT: BeforeValidException', ['exception' => $e]);
            throw new InvalidTokenException();
        }
        catch (SignatureInvalidException $e)
        {
            Log::warning('JWT: SignatureInvalidException', [ 'exception' => $e ]);
            return null;
        }
        catch (UnexpectedValueException $e)
        {
            return null;
        }
    }
}
