@extends('layouts.main')
@section('style')

    <link rel="stylesheet" href="{{asset('css/CoursCSS.css')}}">

@endsection
@section('content')
<div class="row">
    <div class="card">
        <h4><i class="fa fa-bookmark" aria-hidden="true"></i>Liste Des Cours Disponnible </h4>
    </div>
</div>
<div class="row">
    <div class="card card-table">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nom de cours</th>
                    <th>Enseigant</th>
                    <th>Voir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cours as $cour)
                    <tr>
                        <td>{{$cour->cours_name}}</td>
                        <td>{{$cour->Instructor}}</td>
                        <td><i class="fa fa-eye" aria-hidden="true"></i></td>
                        <input type="hidden" value="{{$cour->link}}">
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>

   <div class="cours-view">
        <i class="fa fa-times exit" aria-hidden="true" style="color:white;z-index:10;position:fixed;top:10px;right:50px" ></i>
        <div class="back-hide" style="display:block;text-align:center">
            <iframe src="" frameborder="0" style="height:700px;width: 90%;height: 700px;max-width: 1200px;">
            </iframe>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(".card-table tr").click(function(){
              $link= $(this).children("input").val();
              $(".cours-view iframe").attr('src',$link);
              $(".cours-view").fadeIn();
              $(".back-hide").eq(0).fadeIn();
        })
    })
    $(".exit").click(function(){
        $(".cours-view iframe").attr('src','');
    })
</script>
@endsection
