@extends('_template.main')


@section('pageheader')
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-xl-7">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Novo Aluno</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Alunos</a></li>
                        <li class="breadcrumb-item active">Novo Aluno</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')

<form action="{{ route('student.update', $student) }}" method="post">
    @method('put')
    @include('student.form', ['user' => $student->user])
</form>

@endsection