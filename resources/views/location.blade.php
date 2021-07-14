@extends('Layout.app')
@section('body')
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-auto">
            
                <form action="{{route('getLocation')}}" method="GET">
                    @csrf
                    <button type="submit">Coordenadas</button>
                </form>

            <button type="submit" id="kenobi">Kenobi</button>
            <button type="submit" id="skywalker">Skywalker</button>
            <button type="submit" id="sato">Sato</button>

            <p id="coordinates"></p>
        </div>
    </div>
</section>
@endsection