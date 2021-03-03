<?php


namespace App\Ivgpu\Services;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    private string $client_url;
    private string $client_id;
    private string $client_secret;

    /**
     * ApiService constructor.
     * @param string $client_url
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct(string $client_url, string $client_id, string $client_secret)
    {
        $this->client_url = $client_url;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    public function refreshToken(string $token): ?string
    {
        try {
            $res = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post(
                $this->client_url . '/api/refresh-token',
                [ 'ivgpu_auth' => $token ]
            );
        } catch (\Exception $e) {
            Log::error('RefreshTokenError', [ 'exception' => $e ]);
            return '';
        }

        if ($res->failed()) {
            Log::warning('RefreshTokenServerError', [ 'response' => $res->body() ]);
        }

        return $res->json('ivgpu_auth');
    }

    /**
     * @param string $sub
     * @param string[] $roles
     * @return string|null New token
     */
    public function appendRoles(string $sub, array $roles): ?string
    {
        try {
            $res = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post(
                $this->client_url . '/api/client/roles/' . $sub . '/append',
                [ 'roles' => $roles ]
            );
        } catch (\Exception $e) {
            Log::error('appendRoles', [ 'exception' => $e ]);
            return null;
        }

        if ($res->failed()) {
            Log::warning('appendRolesServerError', [ 'response' => $res->body() ]);
        }

        return $res->json('token');
    }

    private function accessToken(): string
    {
        if (Cache::has('account_access_token')) {
            return Cache::get('account_access_token');
        }

        $token = $this->requestAccessToken();
        Cache::put('account_access_token',$token['access_token'] , $token['expires_in'] / 60);

        return $token['access_token'];
    }

    private function requestAccessToken()
    {
        try {
            return Http::post(
                $this->client_url . '/oauth/token',
                [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                ]
            )->json();
        } catch (\Exception $e) {
            Log::error('RequestAccessTokenError', [ 'exception' => $e ]);
            return '';
        }
    }
}
