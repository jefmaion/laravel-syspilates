@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Adicionar Aula</strong> - {{
                $student->user->name }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Alunos</a></li>
                <li class="breadcrumb-item active">Ficha do Aluno</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')


<div class="row">
    
    <div class="col-4">
        <form action="{{ route('student.registration.class.store', [$student, $registration]) }}" method="post">
        <div class="card card-{{theme()}} card-outline">
            <div class="card-body">
                <h4><strong>{{ $registration->modality->name }}</strong></h4>
               


                @include('student.class.form')

            

                
            </div>

            <div class="card-footer text-right">
                <a name="" id="" class="mr-4 text-muted" href="{{ route('student.registration.show', [$student, $registration]) }}" role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>

                <button type="submit" class="btn bg-{{ theme() }}">
                    <x-icon icon="save">Salvar</x-icon>
                </button>

            </div>

        </form>
        </div>





    </div>


</div>


@endsection

