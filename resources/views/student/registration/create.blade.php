@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fa fa-users" aria-hidden="true"></i> <strong>Nova Modalidade</strong> - {{
                        $student->user->name}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Professores</a></li>
                        <li class="breadcrumb-item"><a href="#">{{
                                $student->user->shortName }}</a></li>
                        <li class="breadcrumb-item active">Modalidades</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row">

    <div class="col-md-3">
        @include('student.info')

    </div>

    <div class="col">
        <form action="{{ route('student.registration.store', $student) }}" method="post">
            <div class="card card-outline card-{{ theme() }}">
                <div class="card-header">
                    <div><strong>Nova Modalidade</strong></div>
                </div>
                <div class="card-body">
                    
                    @csrf
                    @include('student.registration.form')
                </div>
                <div class="card-footer">
                    <a name="" id="" class="mr-3 text-muted" href="{{ route('student.show', $student) }}"
                        role="button">
                        <x-icon icon="back">Voltar</x-icon>
                    </a>
                    <button type="submit" class="btn bg-{{ theme() }}">
                        <x-icon icon="save"></x-icon>
                        Adicionar Modalidade
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>


<!-- Modal -->
@include('student.registration.grade')

@endsection

@section('scripts')
@include('_template.components.select2')
@endsection