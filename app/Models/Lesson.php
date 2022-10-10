<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;

class Lesson extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'nome', 'status',
        'course_id', 'imagem', 'link',
        'inicio', 'termino', 'max_cancelamento',
        'id_mp', 'usuario_modificado'
    ];

    public function courses()
    {
        return $this->belongsTo(ConfigEnergia::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function views()
    {
        return $this->hasMany(View::class)->where(function ($query){
            if(Authenticatable::class->auth()->check()){
                return $query->where('user_id',(Authenticatable::class->auth()->user()->id));
            }
        });
    }

}
