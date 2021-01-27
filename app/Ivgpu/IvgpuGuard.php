<?php


namespace App\Ivgpu;

use App\Ivgpu\Services\TokenService;
use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Validated;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class IvgpuGuard implements Guard
{
    use GuardHelpers;

    private string $name = 'ivgpu';

    /**
     * @var TokenService
     */
    private TokenService $token;

    /**
     * IvgpuGuard constructor.
     * @param TokenService $token
     */
    public function __construct(TokenService $token)
    {
        $this->token = $token;
    }

    public function user(): ?Authenticatable
    {
        if (! is_null($this->user)) {
            return $this->user;
        }

        $data = $this->token->getUserData();

        if (! is_null($data) && $this->user = $this->createOrUpdateUser($data)) {
            $this->fireAuthenticatedEvent($this->user);
        }

        return $this->user;
    }

    protected function createOrUpdateUser($userData): Authenticatable
    {
        if ($user = User::find($userData['sub'])) {
            $user->fill($userData);
            $user->save();

            return $user;
        }

        $user = new User($userData);
        $user->id = $userData['sub'];
        $user->save();

        return $user;
    }

    public function validate(array $credentials = []): bool
    {
        $user = $this->provider->retrieveByCredentials($credentials);

        return $this->hasValidCredentials($user, $credentials);
    }

    protected function hasValidCredentials($user, $credentials): bool
    {
        $validated = ! is_null($user) && $this->provider->validateCredentials($user, $credentials);

        if ($validated) {
            $this->fireValidatedEvent($user);
        }

        return $validated;
    }

    protected function fireAuthenticatedEvent(Authenticatable $user)
    {
        if (isset($this->events)) {
            $this->events->dispatch(new Authenticated(
                $this->name, $user
            ));
        }
    }

    protected function fireValidatedEvent($user)
    {
        if (isset($this->events)) {
            $this->events->dispatch(new Validated(
                $this->name, $user
            ));
        }
    }
}
