<?php

namespace CodePress\CodeUser\Models;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use CodePress\CodeUser\Models\Role;

class User extends Authenticatable implements Authorizable
{
    protected $table = "codepress_users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'codepress_user_roles', 'user_id', 'role_id');
    }

    /**
     * Verifica se usuário tem determinada role
     * @param object | string  $role 
     */
    public function hasRole($role)
    {
        return is_string($role) ? //verifica se parametro passado é do tipo string
            $this->roles->contains('name', $role) : //retorna true caso usuário contenha determinada Role
            $role->intersect($this->roles)->count(); //caso a role passada bate com o conjunto de role do usuário retorna valor maior que zero, que será entendido como true
    }

    /**
     * Verifica se usuário é do tipo administrador
     * @return type
     */
    public function isAdmin()
    {
        return $this->hasRole(Role::ROLE_ADMIN);
    }

}
