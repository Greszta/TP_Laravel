@extends('layouts.app')
@section('title', 'Files Create')
@section('content')

    <h2 class="text-center mt-4 mb-4">@lang('Edit File')</h2>
    <div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-8  col-lg-6 card">
                        <div class="card-body">
                            <form action="{{ route('documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title_en" class="form-label">@lang('Title English')</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror"" id="title_en" name="title_en" value="{{ old('title_en', $document->title['en'] ?? '') }}">
                                    @if($errors->has('title_en'))
                                        <div class="text-danger mt-2">
                                            <span>@lang('lang.title_required')</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="title_fr" class="form-label">@lang('Title French')</label>
                                    <input type="text" class="form-control" id="title_fr" name="title_fr" value="{{ old('title_fr', $document->title['fr'] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Fichier</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                                    @if($errors->has('file'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('file')}}
                                        </div>
                                    @endif
                                    
                                </div>
                                <div class="d-grid">
                                <button type="submit" class="btn btn-primary">@lang('Create')</button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>

@endsection