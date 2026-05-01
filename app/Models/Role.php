<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
     protected $fillable = ['name', 'description'];

     protected $table = 'roles';

     public function userRoles(): BelongsToMany
     {
         return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id')
             ->withPivot('ecosistema_laboral_id')
             ->withTimestamps();
     }
}
