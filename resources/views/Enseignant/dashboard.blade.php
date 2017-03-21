@extends('Enseignant.layouts.main')

@section('content')
<div class="row card" style="margin-bottom:30px">
    <h3><i class="fa fa-tachometer" aria-hidden="true"></i>Tableau de bord </h3>
</div>
<div class="row">
    <div class="col-md-6">
         <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-bookmark" aria-hidden="true"></i> Dernier Cours Ajouté <span><a href="#" class="pull-right">Tous Les Cours</a></span></li>
            <li class="list-group-item item">Formation 1 </li>
            <li class="list-group-item item">Formation 2</li>
            <li class="list-group-item item">Formation 3 </li>
            <li class="list-group-item item">Formation 4</li>
            <li class="list-group-item item">Formation 5 </li>
        </ul>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h5>Ajoute un nouveaux Cours</h5>
        </div>
        <div class="card">
            <h5>Messages</h5>
        </div>
    </div>


</div>

@endsection