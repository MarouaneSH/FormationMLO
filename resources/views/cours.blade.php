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
                    <th>Docs</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cours as $cour)
                    @if($cour->only_subscriber == "0" && !$subscribed) 
                      <tr >                       
                        <td class="select">{{$cour->cours_name}} <span class="free">Gratuis</span></td>
                        <td class="select">{{$cour->Instructor}}</td>
                        <td class="select"><i class="fa fa-eye" aria-hidden="true"></i></td>
                        <td><i class="fa fa-file-text showDocs" aria-hidden="true"></i></td>
                        <input type="hidden" value="{{$cour->link}}">
                         <input type="hidden" value="{{$cour->id}}">
                      </tr>                   
                      @elseif(!$subscribed && $cour->only_subscriber == "1")
                      <tr class="onlySub">   
                        <td>{{$cour->cours_name}} <span class="sub-only">Subscriber's Only</span></td>
                        <td>{{$cour->Instructor}}</td>
                        <td><i class="fa fa-eye" aria-hidden="true"></i></td>
                        <td> <i class="fa fa-ban" aria-hidden="true"></i></td>
                       
                      </tr>
                      @endif
                        @if($subscribed)
                                <tr>
                                    
                                    <td class="select">{{$cour->cours_name}}</td>
                                    <td class="select">{{$cour->Instructor}}</td>
                                    <td class="select"><i class="fa fa-eye" aria-hidden="true"></i></td>
                                    <td><i class="fa fa-file-text showDocs" aria-hidden="true"></i></td>
                                    <input type="hidden" value="{{$cour->link}}">
                                    <input type="hidden" value="{{$cour->id}}">
                                </tr>
                         @endif
                 
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
    <div class="subscribers-only">
          <i class="fa fa-times exit" aria-hidden="true" style="color:white;z-index:10;position:fixed;top:10px;right:50px" ></i>
          <h3>Ce Cours est disponnible uniquement pour les étudient abonnez  <br> <a href="{{route('subscription')}}"><button class="btn btn-success">Abonnez vous</button> </a></h3>
    </div>
    <div class="displayDocs">
        <i class="fa fa-times exit" aria-hidden="true" style="color:white;z-index:10;position:fixed;top:10px;right:50px" ></i>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nom de document</th>
                    <th>Type</th>
                    <th>Télécharger</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="name_docs">TES</td>
                    <td id="type_docs">PDF</td>
                    <td > <a href="" id="link_docs"><i class="fa fa-cloud-download" aria-hidden="true"></a></i></td>
                </tr>
            </tbody>
        </table>
    </div>
    {{$cours->links() }}
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(".showDocs").click(function(e){
             var id_cours=  $(this).parent().parent().children("input").eq(1).val();
            $(".back-hide").eq(1).show();

            $.ajax({
                url:"{{route('getDocs')}}",
                data:{ cours_id :id_cours  },
                beforeSend:function(){
                    $(".loading").show();
                },
                success:function(data){
                    $(".displayDocs tbody").html("");
                    $(".displayDocs").show();
                     $(".loading").hide();
                    there_is_docs = false;
                    $.each(data.docs_link,function(i,docs){
                         there_is_docs = true;
                       
                        $(".displayDocs tbody").append(
                        `
                            <tr>
                                <td>`+docs.Nom+`</td>
                                <td>`+docs.extension+`</td>
                                <td> <a href="`+docs.link+`" download><i class="fa fa-cloud-download" aria-hidden="true"></a></i></td>
                            </tr>
                        
                        `);
                    })
                    if(!there_is_docs)
                    {
                        $(".displayDocs tbody").append(`
                        <tr> <td>Aucun document pour ce cours</td> </tr>`);
                    }
                   
                },
                error:function(){
                    alert("sdsdds");
                }
            })
        })
        $(".card-table td.select").click(function(){
              $link= $(this).parent().children("input").eq(0).val();
              $(".cours-view iframe").attr('src',$link);
              $(".cours-view").fadeIn();
              $(".back-hide").eq(0).fadeIn();
        })
    })
    $(".card-table tr.onlySub").click(function(){
        $(".subscribers-only").slideDown();
        $(".back-hide").eq(1).fadeIn();
    })
    $(".exit").click(function(){
        $(".cours-view iframe").attr('src','');
    })
</script>
@endsection
