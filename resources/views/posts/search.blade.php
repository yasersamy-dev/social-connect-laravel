@extends('layouts.app')

@section('content')

<div class="container">

<h4>Search Results for "{{ $query }}"</h4>

@forelse($users as $user)

<div class="card p-3 mb-2 d-flex justify-content-between flex-row">

<div>
<img src="{{ asset('storage/'.$user->profile_image) }}"
width="40"
class="rounded-circle">

{{ $user->name }}
</div>

<form action="{{ route('friends.send',$user->id) }}" method="POST">
@csrf
<button class="btn btn-primary btn-sm">Add Friend</button>
</form>

</div>

@empty

No users found

@endforelse

</div>

@endsection
