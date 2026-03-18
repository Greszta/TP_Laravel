@extends('layouts.app')
@section('title', 'Étudiant')
@section('content')
<h3 class="row justify-content-center mt-5 mb-3">@lang('Student Info')</h3>
<div class="row justify-content-center my-5">
    <div class="card" style="width: 36rem;">
        <div class="card-header">
            <h5 class="card-title">{{$etudiant->nom}}</h5>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Email: </strong>{{$etudiant->email}}</li>
            <li class="list-group-item"><strong>@lang('Phone'): </strong>{{$etudiant->telephone}}</li>
            <li class="list-group-item"><strong>@lang('Address'): </strong>{{$etudiant->adresse}}</li>
            <li class="list-group-item"><strong>@lang('City'): </strong>{{$etudiant->ville->nom}}</li>
            <li class="list-group-item"><strong>@lang('Birth Date'): </strong>{{$etudiant->date_de_naissance}}</li>
          </ul>
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('etudiant.edit', $etudiant->id)}}" class="btn btn-sm btn-outline-dark m-2">@lang('Edit')</a>
            <form method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger m-2">@lang('Delete')</button>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection