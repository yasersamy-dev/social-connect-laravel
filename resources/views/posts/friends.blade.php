@extends('layouts.app')

@section('content')

<div class="container">

<h4>Your Friends</h4>

@foreach($friends as $friend)

<div class="card p-3 mb-2">

<img src="{{ asset('storage/'.$friend->profile_image) }}"
width="40"
class="rounded-circle">

{{ $friend->name }}

</div>

@endforeach

</div>

@endsection
