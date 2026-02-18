@extends('layouts.app')
@section('title', 'Etudiants List')
@section('content')

<div class="row justify-content-center">
            <div>
                <h3 class="row justify-content-center mt-5 mb-3">Liste d'étudiants</h3>
                <table class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Ville</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                        <tr>
                            <td>{{ $etudiant->nom }}</td>
                            <td>{{ $etudiant->email }}</td>
                            <td>{{ $etudiant->ville->nom }}</td>
                            <td><a href="{{route('etudiant.show', $etudiant->id)}}" class=" link-underline link-underline-opacity-0 link-underline-opacity-100-hover ">Voir plus</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="my-4">{{ $etudiants }}</div>
            </div>
</div>
@endsection