<?php

namespace App\Models;

use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;


class Post 
{
    public $title;
    Public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }


    public static function find($slug) 
    {
       $post =  static::all()->firstWhere('slug', $slug);
       if (!$post) throw new ModelNotFoundException();
       return $post;
    }   

     public static function all() 
     {
        return cache()->rememberForever('posts.all', function () {
             return collect(File::files(resource_path("posts")))
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                ->map(fn ($document) => new Post (
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug,
                ))
                ->sortByDesc('date');
        });  
     }
}