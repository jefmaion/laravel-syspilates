@extends('_template.main')


@section('pageheader')
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="row mb-2">
                <div class="col-sm-6 col-auto">
                    <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Novo Professor</strong></h1>
                </div>
                <div class="col-sm-6 col-xl-auto">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructor.index') }}">Professores</a></li>
                        <li class="breadcrumb-item active">Novo Professor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('content')

    <form action="{{ route('instructor.store') }}" method="post">
        @include('instructor.form')
    </form>

@endsection
