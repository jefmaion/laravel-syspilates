@extends('_template.main')


@section('pageheader')
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-xl-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Nova Categoria</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categorias</a></li>
                        <li class="breadcrumb-item active">Nova Categoria</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')

    <form action="{{ route('category.store') }}" method="post">
        @include('category.form')
    </form>

@endsection