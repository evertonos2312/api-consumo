<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigEnergia extends Model
{
    use HasFactory, SoftDeletes, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'energia_configs';

    protected $fillable = [
        'atual', 'valor_kwh',
        'meta_kwh', 'tipo'
    ];

}
