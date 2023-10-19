@extends('_template.main')


@section('pageheader')
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-xl-7">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Editar Exercício/Aparelho</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exercice.index') }}">Exercício/Aparelhos</a></li>
                        <li class="breadcrumb-item active">Editar Exercício/Aparelho</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')

<form action="{{ route('exercice.update', $exercice) }}" method="post">
    @method('put')
    @include('exercice.form')
</form>

@endsection