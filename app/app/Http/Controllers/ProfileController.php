<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        if($id){
            

            $user = User::where('id', $id)->first();
            $posts = $user->posts()->orderBy('id', 'desc')->get();
            $followers = $user->followers()->orderBy('follower', 'desc')->get();
            $followeds = $user->followeds()->orderBy('follower', 'desc')->get();

            if($user){
            return view('profile', ['user' => $user, 'posts' => $posts, 'followers' => $followers, 'followeds' => $followeds]);
            }else return view('unknownProfile');
        }else{

        $user = User::where('id', Auth::id())->first();
        $posts = Auth::user()->posts()->orderBy('id', 'desc')->get();
        $followers = $user->followers()->orderBy('follower', 'desc')->get();
        $followeds = $user->followeds()->orderBy('follower', 'desc')->get();
        return view('profile', ['user' => $user, 'posts' => $posts, 'followers' => $followers, 'followeds' => $followeds]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'bio' => '',
            'telefone' => '',
            
        ]);
        Auth::user()->update($validatedData);
        
        
        return redirect(route('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(Request $request, User $user)
    {
        $nome_temporario=$_FILES["imagem"]["tmp_name"];
        $nome_real=$_FILES["imagem"]["name"];
        copy($nome_temporario,"./../resources/img/$nome_real");
        $caminho = "./../resources/img/$nome_real";
        $arr = array(
         "foto" => $caminho,
        );
        Auth::user()->update($arr);

        return redirect(route('profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    
    public function follow(Request $request)
    {
        $userId = Auth::id();
        $id = $request->id;
        $user = User::where('id', $id)->first();
        $user->followers()->attach($userId);

        return redirect(url('/profile?id='.$id));


    }

    public function unfollow(Request $request)
    {
        $userId = Auth::id();
        $id = $request->id;
        $user = User::where('id', $id)->first();
        $user->followers()->detach($userId);

        return redirect(url('/profile?id='.$id));


    }
}
