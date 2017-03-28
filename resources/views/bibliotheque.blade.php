@extends('layouts.main')
@section('style')

    <link rel="stylesheet" href="{{asset('css/CoursCSS.css')}}">
    <style>
     .type{
         background:#23bab5;
         position:absolute;
         right:0;
         top:0;
         padding:5px 10px;
         color:white;
     }
     .name
     {
        margin:40px 0;
        font-weight:bold;
            word-wrap: break-word;
     }
     .download
     {
         position:absolute;
         bottom:0;
         color:white;
         background:#2196F3;
             width: 100%;
        left: 0;
        padding:8px

     }
     .card
     {
             border: solid rgba(210, 210, 210, 0.11) 6px;
     }
     .subscribe_only
     {
         background:#FF5252;
     }
    </style>
@endsection
@section('content')
<div class="row">
    
        @foreach($docs as $doc)
        
                <div class="card col-md-3" style="text-align:center;position:relative">
                     <div class="type">
                        {{strtoupper($doc->type)}}
                     </div>
                     <div class="name">
                          {{$doc->name}}
                     </div>
                     @if(!$subscribed)
                         @if($doc->only_subscribe==1)
                             <div class="download subscribe_only">
                                <i class="fa fa-ban" aria-hidden="true"></i> Only subscriber's
                            </div>
                         @else
                            <a href=" {{$doc->link}}" download>
                                <div class="download">
                                    <i class="fa fa-cloud-download" aria-hidden="true"></i> Gratuis
                                </div>
                            </a>

                         @endif

                     @else
                        <a href=" {{$doc->link}}" download>
                            <div class="download">
                                <i class="fa fa-cloud-download" aria-hidden="true"></i> Télecharger
                            </div>
                        </a>
                     @endif
                </div>
               

        @endforeach

        
</div>
<div class="row">
{{ $docs->links() }}
</div>
@endsection