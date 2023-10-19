@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Detales da Modalidade</strong> - {{
                $modality->name }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('modality.index') }}">Modalidades</a></li>
                <li class="breadcrumb-item active">Detalhes</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')



<div class="card card-outline-secondary">
    <div class="card-body">

        <h4><strong>{{ $modality->name }}</strong> <span class="text-muted">{{ $modality->nick }}</span></h4>
        <div>Cadastrado {{ $modality->created_at->diffForHumans() }}</div>
       

    </div>

    <div class="card-footer">
        <a name="" id="" class="btn btn-outline-secondary" href="{{ route('modality.index') }}" role="button">
            <x-icon icon="back">Voltar</x-icon>
        </a>

        <a name="" id="" class="btn btn-outline-warning" href="{{ route('modality.edit', $modality) }}" role="button">
            <x-icon icon="edit">Editar</x-icon>
        </a>

        <x-modal-delete id="{{ $modality->id }}" route="{{ route('modality.destroy', $modality) }}">
            <x-icon icon="delete">Excluir</x-icon>
        </x-modal-delete>
    </div>
</div>
@endsection