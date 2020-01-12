<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user = User::where('id', Auth::id())->first();
        
        
        return view('home')->with('user', $user);
    }

    public function store(Request $request)
    {
        if(!empty($_FILES["media"]["tmp_name"])){
        $nome_temporario=$_FILES["media"]["tmp_name"];
        $nome_real=$_FILES["media"]["name"];
        copy($nome_temporario,"./../resources/img/posts/$nome_real");
        $caminho = "./../resources/img/posts/$nome_real";

        $arr = array(
            "user_id" => Auth::id(),
            "text" => $request->input('text'),
            "media" => $caminho,

        );
    }else{
        $arr = array(
            "user_id" => Auth::id(),
            "text" => $request->input('text'),

        );
    }
        Post::create($arr);

        return redirect(route('home'));

    }
}
