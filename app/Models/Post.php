<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;


class Post 
{
    public static function find($slug) {
         if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
             throw new ModelNotFoundExecption();
         }
        return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
         
    }   

     public static function all() {

        $files = File::files(resource_path("posts"));

        return array_map(function ($file) {
            return $file->getContents();
         }, $files);
     }
}