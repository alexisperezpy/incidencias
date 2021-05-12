<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name','description','fecha_inicio',
    ] ;
    
    /* Relación con Usuarios */
    public function users(){
        return $this->belongsToMany('App\User');
    }

    /* Relación con Categorias */
    public function categorias(){
        return $this->hasMany('App\Category');
    }

    /* Relacion con niveles */
    public function levels()
    {
        return $this->hasMany('App\Level');
    }
}
