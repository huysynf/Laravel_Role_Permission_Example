<?php

namespace App\Models;

use App\Casts\Product\Title;
use App\Enums\PostState;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $table = 'posts';

    protected $fillable = [
      'title',
      'body',
      'user_id',
    'state'
    ];


//    public function title():Attribute
//    {
//        return new Attribute(
//          get: fn($value) => strtoupper($value),
//          set: fn($value) => 'new post-'.$value
//        );
//    }

    protected $casts = [
        'title' => Title::class,
        'state' => PostState::class
    ];

    public function toSearchableArray()
    {
        return [
          'title' => $this->title,
          'body' => $this->body
        ];
    }

}
