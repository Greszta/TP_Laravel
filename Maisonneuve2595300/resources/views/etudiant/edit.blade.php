@extends('layouts.app')
@section('title', 'Modification Étudiant')
@section('content')
    <h3 class="row justify-content-center mt-5 mb-3">Modifier Étudiant</h3>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="card col-md-6">
            <div class="card-body">
                <form method="post" class="row g-3">
                    @method('put')
                    @csrf
                    <div class="col-12">
                            <label for="nom" class="form-label">@lang('Name')</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{old('nom', $etudiant->nom) }}">
                            @if($errors->has('nom'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('nom')}}
                                </div>
                            @endif
                    </div>
                    <div class="col-md-8">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $etudiant->email) }}">
                            @if($errors->has('email'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('email')}}
                                </div>
                            @endif
                    </div>
                    <div class="col-md-4">
                            <label for="telephone" class="form-label">@lang('Phone')</label>
                            <input type="tel" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" placeholder="123-4567-8901" value="{{old('telephone', $etudiant->telephone) }}">
                            @if($errors->has('telephone'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('telephone')}}
                                </div>
                            @endif
                    </div>
                    <div class="col-12">
                            <label for="adresse" class="form-label">@lang('Address')</label>
                            <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{old('adresse', $etudiant->adresse) }}">
                            @if($errors->has('adresse'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('adresse')}}
                                </div>
                            @endif
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">@lang('City')</label>
                        <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror" aria-label="Default select example">
                          <option value="{{old('ville_id', $etudiant->ville_id) }}">{{old('ville', $etudiant->ville->nom) }}</option>
                          @foreach($villes as $ville)
                          <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('ville_id'))
                                <div class="text-danger mt-1">
                                    <span>The ville field is required.</span>
                                </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                            <label for="date_de_naissance" class="form-label">@lang('Birth Date')</label>
                            <input type="date" class="form-control @error('date_de_naissance') is-invalid @enderror" id="date_de_naissance" name="date_de_naissance" value="{{old('date_de_naissance', $etudiant->date_de_naissance) }}">
                            @if($errors->has('date_de_naissance'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('date_de_naissance')}}
                                </div>
                            @endif
                    </div>
                    <button type="submit" class="btn btn-outline-dark mt-5">@lang('Update')</button>
                </form>
            </div>
        </div>
    </div>
@endsection