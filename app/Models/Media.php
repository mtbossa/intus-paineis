<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'path',
        'type',
        'duration',
        'extension'
    ];      

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
