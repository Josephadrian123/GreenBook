@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Glossary</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php
                        $token = "WS9nbCtSVzN6RExhdDdMU1lGd0Vvdz09";
                        $url = "https://trefle.io/api/plants?token=".$token;
                        $result = curl_init($url);
                        curl_setopt($result, CURLOPT_RETURNTRANSFER, true);

                        $plantas = json_decode(curl_exec($result), true);
                        $i=0;
                        foreach($plantas as $planta){
                            echo "<a class='btn btn-link link' href='#'>".$plantas[$i]['slug']."</a>";
                            $i++;
                        }
                        
                    ?>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
