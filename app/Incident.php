<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use SoftDeletes;
    
    protected $appends = ['state'];

    // Relaciones
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function level(){
        return $this->belongsto('App\Level');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function support()
    {
        return $this->belongsTo('App\User', 'support_id');
    }

    public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }

    /* Accesor para mostrar severity_full*/
    public function getSeverityFullAttribute()
    {
        switch ($this->severity) {
            case 'A':
                return 'Alta';
            case 'M':
                return 'Media';
            default:
                return 'Normal';
        }
    }

    /* Accesor para mostrar cierto numero de caracteres */
    public function getDescriptionShortAttribute(){
        return mb_strimwidth($this->description,0,35,'...');
    }

    // Support Name
    public function getSupportNameAttribute(){
        if($this->support)
            return $this->support->name;

        return 'Sin asignar';
    }

    public function getStateAttribute(){
        if($this->active === 0)
            return 'Resuelto';
        
        if($this->support_id)
            return 'Asignado';

        return 'Pendiente';
    }

    public function getCategoryNameAttribute(){
        if($this->category)
            return $this->category->name;
        
        return 'General';
    }

}
