@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Detalhes da Aula</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('class.index') }}">Modalidades</a></li>
                <li class="breadcrumb-item active">Detalhes</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')



<div class="row">
    <div class="col-6">
        <div class="card card-outline card-{{ theme() }}">
            <div class="card-body">
        
                <h4><strong>{{ $class->fullDate }} - {{ $class->time }}</strong> <span class="text-muted"></span></h4>
               
                <h6 class="border-bottom mt-3"><strong>Modalidade</strong></h6>
                <div>{{ $class->modality->name }}</div>

                <h6 class="border-bottom mt-3"><strong>Modalidade</strong></h6>
                <div><strong>Aluno:</strong> {{ $class->student->user->name ?? $class->name }}</div>
                <div><strong>Professor:</strong> {{ $class->instructor->user->name }}</div>
               
                <br>
        
                <h6 class="border-bottom mt-3"><strong>Evolução da Aula</strong></h6>
                <div>{{ $class->evolution }}</div>
               
        
            </div>
        
            <div class="card-footer">
                <a name="" id="" class="mr-3 text-muted" href="{{ route('class.index') }}" role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>
        
                <a name="" id="" class="btn btn-outline-warning" href="{{ route('class.edit', $class) }}" role="button">
                    <x-icon icon="edit">Editar</x-icon>
                </a>
        
                <x-modal-delete id="{{ $class->id }}" route="{{ route('class.destroy', $class) }}">
                    <x-icon icon="delete">Excluir</x-icon>
                </x-modal-delete>
            </div>
        </div>
    </div>
</div>
@endsection