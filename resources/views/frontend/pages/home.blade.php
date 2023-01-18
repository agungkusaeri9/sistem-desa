@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <x-Frontend.CardPost title="{{ $post->title }}" image="{{ $post->image() }}" slug="{{ $post->slug }}"></x-Frontend.CardPost>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
