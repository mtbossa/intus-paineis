<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $dates = [
        'start_date',
        'end_date'
    ];

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

    public function displays()
    {
        return $this->belongsToMany(Display::class)->withTimestamps();
    }

    /**
     * Automatically casts the date string in 'd/m/Y' format to 'Y-m-d' when
     * setting this attribute ($post->start_date = '18/02/2002')
     * 
     * @param  string $attribute
     * @return void
     */
    public function setStartDateAttribute($attribute)
    { 
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $attribute)->format('Y-m-d');
    }

    /**
     * Automatically casts the date string in 'Y-m-d' format to an instace of Carbon::class
     * when getting this attribute ($post->start_date)
     * 
     * @param  string $attribute
     * @return void
     */
    public function getStartDateAttribute($attribute)
    { 
        return Carbon::createFromFormat('Y-m-d', $attribute);
    }

    public function setEndDateAttribute($attribute)
    { 
        $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $attribute)->format('Y-m-d');
    }

    public function getEndDateAttribute($attribute)
    { 
        return Carbon::createFromFormat('Y-m-d', $attribute);
    }
  
}
