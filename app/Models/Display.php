<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    use HasFactory;

    protected $table = 'displays';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'location'
    ];      

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    /**
     * Returns the path (route) of this current model.
     * @return string Path (URL) to the current model page
     */
    public function path()
    {
        return "/displays/{$this->id}";
    }
}
