@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Feed</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row justify-content-center">
                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalPost">New Post</button>
                    </div>

                    <div class="modal fade" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" enctype="multipart/form-data" action="{{ route('home.store') }}">
                               
                               @csrf
                            <div class="form-group row">
                               <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Text') }}</label>

                            <div class="col-md-6">
                                <textarea id="name"  name="text"></textarea>
                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
                            <div class="col-md-6">
                               <input class="btn btn-sm btn-outline-success" data-container-upload = "inputfile" type="file" name="media"/>
                            </div>
                               
                              
                               
                             
                               
                           
                           
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-success">Save</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                
                </div>
                <br>
                <br>
                <div class="col justify-content-center">
                    @foreach($posts as $post)
                    @if (!empty($post['media']))
                                                    
                                                    <div class='card card-post col'>
                                                    <div class='card-header row'>
                                                        <div class='row col'>
                                                            <img src="{{ App\User::where('id', $post['user_id'])->get()->first()['foto'] }}">
                                                        
                                                            <a class='nav-link titulo' href="profile?id={{App\User::where('id', $post['user_id'])->get()->first()['id']}}" style='border: none; outline-style: none;'>{{App\User::where('id', $post['user_id'])->get()->first()['name']}}</a>
                                                            
                                                        </div>
                                                        @if(Auth::id() == App\User::where('id', $post['user_id'])->get()->first()['id'])
                                                        <div class="ml-3">
                                                            <form method="post" action="{{ route('removePost') }}">
                                                            @csrf
                                                            <input type="hidden" name='id' value="{{ $post['id'] }}"/>
                                                            <button type="submit" class="close" data-dismiss="modal" aria-label="Fechar">
                                                            <span aria-hidden="true">&times;</span>  </button>
                                                            </form>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class=" card-legend">{{ $post['text'] }}</div>
                                                    <div class='card-content row'>
                                                    <img src="{{ $post['media'] }}" style='width: 100%;'>
                                                    </div>
                                                    <div class='card-footer row'>
                                                
                                        aq eh o footer ok
                                        </div>
                                                </div>
                                                
                                                <br>
                                           
                                           
                                            @else
                                        
                                        <div class='card col card-post'>
                                        <div class='card-header row'>
                                            <div class='row col'>
                                                <img src=" {{ App\User::where('id', $post['user_id'])->get()->first()['foto'] }}">
                                                <a class='nav-link titulo' href="profile?id={{App\User::where('id', $post['user_id'])->get()->first()['id']}}" style='border: none; outline-style: none;'>{{ App\User::where('id', $post['user_id'])->get()->first()['name']}}</a>
                                            </div>
                                            @if(Auth::id() == App\User::where('id', $post['user_id'])->get()->first()['id'])
                                            <div class="ml-3">
                                                <form method="post" action="{{ route('removePost') }}">
                                                    @csrf
                                                    <input type="hidden" name='id' value="{{ $post['id'] }}"/>
                                                    <button type="submit" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>  </button>
                                                </form>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="">{{ $post['text'] }}</div>
                                        <div class='card-footer row'>
                                        aq eh o footer ok
                                        </div>
                                    </div>
                                    
                                    <br>
                                            @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
