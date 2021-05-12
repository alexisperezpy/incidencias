<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'selected_project_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*Relación usuario proyectos*/
    public function projects(){
        return $this->belongsToMany('App\Project');
    }

    public function getListOfProjectsAttribute()
    {
        if ($this->role == 1)
            return $this->projects;
        
        return Project::all();
    }
   
    /* Accesors para saber si un usuario es admin, cliente o soporte*/ 
    public function getIsAdminAttribute()
    {
        return $this->role == 0;
    }

    public function getIsSupportAttribute()
    {
        return $this->role == 1;
    }

    public function getIsClientAttribute(){
        return $this->role == 2;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
