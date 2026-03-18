@extends('layouts.app')
@section('title', 'Forum')
@section('content')

<div class="container">
    <h2 class="text-center my-5">Forum</h2>
    @foreach($articles as $article)
    <div class="card my-4 mx-auto w-75">
  <div class="card-header">
    <h4>{{ $article->title ? $article->title[app()->getLocale()] ?? $article->title['en'] : ''}}</h4>
  </div>
  <div class="card-body">
    <figure>
      <blockquote class="blockquote">
        <p>{{ $article->content ? $article->content[app()->getLocale()] ?? $article->content['en'] : ''}}</p>
      </blockquote>
      <figcaption class="blockquote-footer">
        {{ $article->user->name }} <cite title="Source Title">{{ $article->created_at->diffForHumans() }}</cite>
      </figcaption>
    </figure>
  </div>
  <div class="d-flex justify-content-end m-2">
    @if($article->user_id === auth()->id())
    <a class="btn btn-primary me-2" href="{{route('articles.edit', $article)}}">@lang('Edit')</a>
    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">@lang('Delete')</button>
    </form>
    @endif
  </div>
</div>
    @endforeach
    <div class="d-flex justify-content-center my-4">{{ $articles }}</div>
</div>

@endsection