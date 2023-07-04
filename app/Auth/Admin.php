<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Fluent;

class Admin extends Fluent implements Authenticatable, Authorizable
{
    /**
     * All of the attributes set on the fluent instance.
     *
     * @var array<TKey, TValue>
     */
    protected $attributes = [
        'id' => 'admin',
    ];

    public function getAuthIdentifierName()
    {
        return 'role';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return 'admin';
    }

    public function getRememberToken()
    {
        return '';
    }

    public function setRememberToken($value)
    {
        //
    }

    public function getRememberTokenName()
    {
        return '';
    }

    public function can($abilities, $arguments = [])
    {
        return true;
    }
}
