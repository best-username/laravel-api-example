<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname',
    ];

    /**
    * Relations
    */
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    
}
