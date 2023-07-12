<?php

namespace App\Models;

use App\Models\Shop\Manager;
use App\Models\Shop\Shop;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends=['role'];

    public function getRoleAttribute(){
        $role= $this->roles()->first();
        return (object)['id'=>$role->id,'name'=>$role->name];
    }

    public function shop(){
        return $this->belongsTo(Shop::class,'id','user_id');
    }
    public function manager(){
        return $this->belongsTo(Manager::class,'id','user_id');
    }

}
