@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Detalhes do Exercício/Aparelho</strong> - {{
                $exercice->name }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('exercice.index') }}">Exercício/Aparelho</a></li>
                <li class="breadcrumb-item active">Detalhes</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')



<div class="card card-outline card-{{ theme() }}">
    <div class="card-body">

        <h4><strong>{{ $exercice->name }}</strong></h4>
        <div>Cadastrado {{ $exercice->created_at->diffForHumans() }}</div>
       

    </div>

    <div class="card-footer">
        <a name="" id="" class="btn btn-outline-secondary" href="{{ route('exercice.index') }}" role="button">
            <x-icon icon="back">Voltar</x-icon>
        </a>

        <a name="" id="" class="btn btn-outline-warning" href="{{ route('exercice.edit', $exercice) }}" role="button">
            <x-icon icon="edit">Editar</x-icon>
        </a>

        <x-modal-delete id="{{ $exercice->id }}" route="{{ route('exercice.destroy', $exercice) }}">
            <x-icon icon="delete">Excluir</x-icon>
        </x-modal-delete>
    </div>
</div>
@endsection