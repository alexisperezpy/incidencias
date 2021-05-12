<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use SoftDeletes;

    public function category(){
        return $this->belongsTo('App\Category');
    }

    /* Accesor para mostrar severity_full*/
    public function getSeverityFullAttribute()
    {
        switch ($this->severity) {
            case 'A':
                return 'Alto';
            case 'M':
                return 'Medio';
            default:
                return 'Normal';
        }
    }

    /* Accesor para mostrar cierto numero de caracteres */
    public function getDescriptionShortAttribute(){
        return mb_strimwidth($this->description,0,35,'...');
    }
}
