@extends('_template.main')


@section('pageheader')
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-xl-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Editar Categoria</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categorias</a></li>
                        <li class="breadcrumb-item active">Editar Categoria</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')

<form action="{{ route('category.update', $category) }}" method="post">
    @method('put')
    @include('category.form')
</form>

@endsection