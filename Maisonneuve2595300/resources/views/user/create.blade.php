@extends('layouts.app')
@section('title', 'Création Utilisateur')
@section('content')
    <h3 class="row justify-content-center mt-5 mb-3">@Lang('Create Account')</h3>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="card col-md-6">
            <div class="card-body">
                <form method="POST" class="row g-3">
                    @csrf
                    <div class="col-12">
                            <label for="name" class="form-label">@lang('Name')</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('name')}}
                                </div>
                            @endif
                    </div>
                    <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                            @if($errors->has('email'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('email')}}
                                </div>
                            @endif
                    </div>
                    <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="">
                            @if($errors->has('password'))
                                <div class="text-danger mt-1">
                                    {{$errors->first('password')}}
                                </div>
                            @endif
                    </div>
                    <button type="submit" class="btn btn-outline-dark mt-5">@Lang('Continue')</button>
                </form>
            </div>
        </div>
    </div>
@endsection