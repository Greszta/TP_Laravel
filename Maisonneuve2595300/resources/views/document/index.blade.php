@extends('layouts.app')
@section('title', 'Files List')
@section('content')

<div class="row justify-content-center mx-auto w-80">
            <div>
                <h3 class="row justify-content-center mt-5 mb-3">@lang('File List')</h3>
                <table class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th style="width: 15%;">@lang('Name')</th>
                            <th style="width: 43%;">@lang('Title')</th>
                            <th style="width: 22%;"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->user->name }}</td>
                            <td> {{ $document->title ? $document->title[app()->getLocale()] ?? $document->title['en'] : ''}}</td>
                            <td class="text-end">
                        @if($document->user_id === auth()->id())
                            <a class="btn btn-outline-warning me-2" href="{{route('documents.edit', $document)}}">@lang('Edit')</a>
                            <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger me-2">@lang('Delete')</button>
                            </form>
                        @endif    
                        <a href="{{ Storage::url($document->filename) }}" target="_blank" class="btn btn-outline-primary">Télécharger</a>   
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="my-4">{{ $documents }}</div>
            </div>
</div>

@endsection