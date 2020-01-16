@extends('layouts.app')

@section('content')
@csrf
 <script>
    
    var timerI = null;
    var timerR = false;
    

    function para(){
        
        if(timerR){
        clearTimeout(timerI);
        timerR = false;
        }

    }

    function comeca(){
        para();
        lista();
    }

    function lista(){
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        $.ajax({
            
            url:"{{ url('/list') }}",
            cache: false,
            success: function(textStatus){
                
                $("#lista").html(textStatus);
                $("#lista").animate({scrollTop: $('#lista').prop("scrollHeight")}, 0);
                
            },
            error: function() {
                
        }
        })
        timerI = setTimeout("lista()", 1000);
        timerR = true;
        
        
    }
    

    $(document).ready(function(){
        comeca();
        
        
        
    });


    
</script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">{{ $receiver['name'] }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    

                    <div id='lista' class="col"></div>
                        <form id="form-chat" action="" method="POST" enctype="multipart/form-data" ajax="true">
                        @method('GET')
                        
                            <div class="col">
                                <div class="input-group">
                                    <input autocomplete='off' type="text" name="mensagem" id="mensagem" placeholder="Digite uma mensagem." class="form-control"/>&nbsp;&nbsp;
                                    <span class="input-group-btn">
                                        <input type="submit" value="&rang;&rang;" class="btn btn-dark">
                                        <input type="hidden" name="env" value="envMsg">
                                    </span>
                                </div>
                            </div>
                        </form>
                        @php
                    if(isset($_POST['env']) && $_POST['env'] == "envMsg"){
                        $text = $_POST['mensagem'];
                        
                        if(empty($text)){
                            
                        }else{

                            date_default_timezone_set('America/Sao_Paulo');
                            $message = new App\Message;
                            $message->sender_id = Auth::id();
                            $message->receiver_id = $receiver['id'];
                            $message->text = $text;
                            $message->save();
                            
                        }
                    }
                    @endphp
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
