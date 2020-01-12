@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col md-4">
            <div class="card">
                <div class="card-header titulo"> Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container emp-profile">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{ $user['foto'] }}" alt=""/>
                            @if($user['id'] == Auth::id())
                            <span data-toggle="modal" data-target="#changePhoto" class="file btn btn-lg btn-success col-md-4">
                                Change Photo
                                
                                
                             </span>
                            @else
                            <div>
                            &nbsp;
                            </div>
                            @endif
                            <div class="modal fade" id="changePhoto" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data" action="{{ route('updatePhoto', $user) }}">
                               
                                @csrf
                                <input class="btn btn-outline-success" data-container-upload = "inputfile" type="file" name="imagem"/>
                                
                               
                                
                                </div>
                                <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                            <button type="sumbit" class="btn btn-outline-success">Save</button>
                            </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class='row justify-content-center'>
                           {{ $followers->count() }} followers
                        </div>
                        <div class='row justify-content-center'>
                          @if($user['id'] != Auth::id())

                          @if(!$followers->contains(Auth::id()))
                          <form method="post" action="{{ route('follow', $user) }}">
                          @csrf
                          <input type="hidden" name="id" value="{{ $user['id'] }}"/>
                          <button class='btn btn-outline-success'>Follow</button>
                          </form>

                          @else
                          <form method="post" action="{{ route('unfollow', $user) }}">
                          @csrf
                          <input type="hidden" name="id" value="{{ $user['id'] }}"/>
                          <button class='btn btn-outline-success'>Unfollow</button>
                          </form> 
                          @endif
                          @endif

                          

                        </div>
                    
                    </div>
                    
                    <div class="col-md-5">
                        <div class="profile-head">
                                    <h5>
                                    {{ $user['name'] }}
                                    </h5>
                                    <h6>
                                       {{ $user['bio'] }}
                                    </h6>
                                    
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="plantas-tab" data-toggle="tab" href="#plantas" role="tab" aria-controls="plantas" aria-selected="false">Plants</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($user['id'] == Auth::id())
                    <div class="col-md-3">
                        <a class="nav-link profile-edit-btn" name="btnAddMore" data-toggle="modal" data-target="#ModalEdit"> Edit Profile <img src="{{asset('../resources/img/gear.png')}}" style="height: 30px"></a>
                         
                        
                    </div>
                    @endif
                </div>

                <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{ route('profile.update', Auth::id()) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user['name'] }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>

                            <div class="col-md-6">
                                <input id="bio" type="text" class="form-control" name="bio" value="{{ $user['bio'] }}" autocomplete="bio">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user['email'] }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    

                    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                            <button type="sumbit" class="btn btn-outline-success">Save</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>

                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user['id'] }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user['name'] }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user['email'] }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Bio</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user['bio'] }}</p>
                                            </div>
                                        </div>
                                        
                                        
                            </div>
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                       

                                       @if (!$user->posts()->count())
                                       <div class="row col-md-10 justify-content-center">
                                            <h3>No posts yet :(</h3>
                                       </div>
                                       @endif
                                     
                                       @foreach ( $posts as $post)
                                           @if (!empty($post['media']))
                                                    <div class='card card-post col-md-9'>
                                                    <div class='card-header row'><div class='row col-md-4'><img src="{{ $user['foto'] }}">&nbsp;<a class='nav-link titulo row' href="profile?id={{$user['id']}}" style='border: none; outline-style: none;'>{{$user['name']}}</a></div></div>
                                                    {{ $post['text'] }}
                                                    <div class='row card-content'>
                                                    <img src="{{ $post['media'] }}" style='width: 485px;'>
                                                    </div>
                                                    <div class='card-footer row'>
                                        aq eh o footer ok
                                        </div>
                                                </div>
                                                <br>
                                           
                                           
                                            @else
                                        <div class='card col-md-9 card-post'>
                                        <div class='card-header row'><div class='row col-md-4'><img src=" {{ $user['foto'] }}">&nbsp;<a class='nav-link titulo row' href="profile?id={{$user['id']}}" style='border: none; outline-style: none;'>{{ $user['name']}}</a></div></div>
                                        {{ $post['text'] }}
                                        <div class='card-footer row'>
                                        aq eh o footer ok
                                        </div>
                                    </div>
                                    <br>
                                            @endif
                               
                                       
                                       @endforeach

                                       
                            </div>
                            <div class="tab-pane fade" id="plantas" role="tabpanel" aria-labelledby="plantas-tab">
                                <div class="row offset-8">
                                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalPlant">New Plant</button>
                                </div>

                                <div class="modal fade" id="modalPlant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Plant</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="post" enctype="multipart/form-data" action="">
                                        
                                        @csrf
                                        <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" id="name"  name="name"></input>
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
                        </div>
                    </div>
                </div>
                     
        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection