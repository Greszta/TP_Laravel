@extends('layouts.app')
@section('title', 'Modification Article')
@section('content')
    <h2 class="text-center mt-4 mb-4">@lang('Edit Post')</h2>
    <div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-8  col-lg-6 card">
                        <div class="card-body">
                            <form action="{{ route('articles.update', $article)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title_en" class="form-label">@lang('Title English')</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror"" id="title_en" name="title_en" value="{{ old('title_en', $article->title['en'] ?? '') }}">
                                    @if($errors->has('title_en'))
                                        <div class="text-danger mt-2">
                                            <span>@lang('lang.title_required')</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="content_en" class="form-label">@lang('Content English')</label>
                                    <textarea type="text" rows="4" class="form-control @error('content_en') is-invalid @enderror"" id="content_en" name="content_en" placeholder="@lang('lang.write_post')">{{ old('content_en', $article->content['en'] ?? '') }}</textarea>
                                    @if($errors->has('content_en'))
                                        <div class="text-danger mt-2">
                                            <span>@lang('lang.content_required')</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="title_fr" class="form-label">@lang('Title French')</label>
                                    <input type="text" class="form-control" id="title_fr" name="title_fr" value="{{ old('title_fr', $article->title['fr'] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="content_fr" class="form-label">@lang('Content French')</label>
                                    <textarea type="text" rows="4" class="form-control" id="content_fr" name="content_fr" placeholder="@lang('lang.write_post')">{{ old('content_fr', $article->content['fr'] ?? '') }}</textarea>
                                </div>
                                <div class="d-grid">
                                <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                </div>
                            </form>
</div>
            </div>
        </div>
    </div>
@endsection