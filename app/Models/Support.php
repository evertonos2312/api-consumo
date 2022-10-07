<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['status', 'description', 'lesson_id'];

    public $statusOptions = [
        'P' => 'Pendente, aguardando professor',
        'A' => 'Pendente, aguardando aluno',
        'C' => 'Finalizado'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(ReplySupport::class);
    }


}
