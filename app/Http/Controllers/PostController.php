<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(){
        $albums=http::get('http://192.168.2.99:8008/albums.json')->json();
        $posts=http::get('http://192.168.2.99:8008/posts.json')->json();
        $todos=http::get('http://192.168.2.99:8008/todos.json')->json();
        $users=http::get('http://192.168.2.99:8008/users.json')->json();
        $photos=http::get('http://192.168.2.99:8008/photos.json')->json();
        $collection_albums=collect($albums);
        $collection_posts=collect($posts);
        $collection_todos=collect($todos);
        $collection_users=collect($users);
        $collection_photos=collect($photos);

        $countPost=$collection_posts->countBy('userId');
        $countTodo=$collection_todos->countBy('userId');
        $countAlbum=$collection_albums->countBy('userId');
        $countPhoto=$collection_photos->countBy('albumId');

        //belum bisa joinkan json album dan photo untuk mencari jumlah photo per user
        dd($countPhoto);
        return view('index',[
            'names'=>$countAlbum
        ]);
    }
}
