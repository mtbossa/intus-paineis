<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'duration', 
        'start_date', 
        'end_date', 
        'start_time',
        'end_time',
        'media_id',
        'recurrence_id'
    ];

    public function recurrence()
    {
        return $this->belongsTo(Recurrence::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function displays() {
        return $this->belongsToMany(Display::class)->withTimestamps();
    }
}
