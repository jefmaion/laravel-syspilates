@extends('_template.main')


@section('pageheader')
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Novo Exercício/Aparelho</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exercice.index') }}">Exercícios/Aparelhos</a></li>
                        <li class="breadcrumb-item active">Novo Exercício/Aparelho</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')

    <form action="{{ route('exercice.store') }}" method="post">
        @include('exercice.form')
    </form>

@endsection