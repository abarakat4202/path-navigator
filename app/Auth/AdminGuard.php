<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AdminGuard implements Guard
{
    /**
     * Indicates if the logout method has been called.
     *
     * @var bool
     */
    protected $loggedOut = false;

    /**
     * Indicates if the logout method has been called.
     *
     * @var ?Admin
     */
    protected $user = null;

    public function __construct(
        protected Request $request
    ) {
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function check(): bool
    {
        if (! is_null($this->user())) {
            return true;
        }

        return $this->request->hasHeader('X-QUEEN-TECH-AUTHORIZATION')
                    && $this->validate(['api_key' => $this->request->header('X-QUEEN-TECH-AUTHORIZATION')]);
    }

    public function guest(): bool
    {
        return ! $this->check();
    }

    public function user(): ?Admin
    {
        if ($this->loggedOut) {
            return null;
        }

        if (! is_null($this->user)) {
            return $this->user;
        }

        if (Session::get($this->getName())) {
            $this->setUser(new Admin());
        }

        return $this->user;
    }

    public function id(): string
    {
        return $this->user->getAuthIdentifier();
    }

    public function validate(array $credentials = []): bool
    {
        if (empty($credentials['api_key'])) {
            return ($credentials['username'] ?? null) == Config::get('admin.username')
                        && ($credentials['password'] ?? null) == Config::get('admin.password');

        }

        return $credentials['api_key'] === Config::get('admin.api_key');
    }

    public function hasUser(): bool
    {
        return true;
    }

    public function setUser(Authenticatable $user): void
    {
        $this->user = $user;
    }

    public function attempt(array $credentials = []): bool
    {
        if ($this->validate($credentials)) {
            $this->login(new Admin([]));

            return true;
        }

        return false;
    }

    public function login(Authenticatable $user): void
    {
        $this->updateSession($user->getAuthIdentifier());
        $this->setUser($user);
    }

    protected function updateSession(string $id): void
    {
        Session::put($this->getName(), $id);

        Session::save();
    }

    public function getName(): string
    {
        return 'login_admin'.'_'.sha1(static::class);
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout()
    {
        Session::remove($this->getName());
        $this->user = null;
        $this->loggedOut = true;
    }
}
