<meta name="csrf-token" content="{{ csrf_token() }}">

<form action="{{route('verfication_demande')}}" method="post">
    {{csrf_field()}}
    <button type="submit">sdsd</button>
</form>