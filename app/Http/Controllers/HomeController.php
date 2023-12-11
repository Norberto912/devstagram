<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
      //  $this->meddlewere('auth');        
    }
    //
    public function __invoke()
    
    {
        //obrenere aquin sigues
        $ids=auth()->user()->followings->pluck('id')->toArray();
        $posts=Post::whereIn('user_id', $ids)->latest()->paginate(20);
        
        return view('home',[
            'posts'=>$posts
        ]);
    }
}
