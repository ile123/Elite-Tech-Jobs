@extends('layouts.app')

@section('content')

<div class="container">
    <h1>My Dribble Designs</h1>
    <div class="row">
        @foreach ($designs as $design)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="{{ $design['images']['normal] }}}" alt="Koko">
                    <div class="card-body">
                        <p class="card-text">{{ $design['title'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $design['views_count'] views }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

@endsection