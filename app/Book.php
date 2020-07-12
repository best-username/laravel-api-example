<?php

namespace App;

use App\User;
use App\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'pages', 'annotation', 'picture',
    ];

    /**
    * Relations
    */
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    
    /**
     * Accessors
     */
    
    public function getPictureAttribute($value)
    {
        $file_path = \Storage::url($value);
        return asset($file_path);
    }
}
