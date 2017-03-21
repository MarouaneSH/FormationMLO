@extends('layouts.main')
@section('style')

    <link rel="stylesheet" href="{{asset('css/styleACCOUNT.css')}}">

@endsection
@section('content')
<div class="row">
    <div class="card">
        <h4><i class="fa fa-bookmark" aria-hidden="true"></i>Liste Des Cours Disponnible</h4>
    </div>
</div>
<div class="row">
    <div class="card">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Cours</th>
                    <th>Enseigant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="cours-view">
    <div class="back-hide" style="display:block">
    <iframe src="" frameborder="0">
        
    </iframe>
</div>
</div>
@endsection


