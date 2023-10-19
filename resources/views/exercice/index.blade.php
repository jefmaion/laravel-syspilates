@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Exercícios/Aparelhos</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Exercícios/Aparelhos</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="card card-outline card-{{ theme() }}">
        <div class="card-body">

            

            <a name="" id="" class="btn bg-{{ theme() }}" href="{{ route('exercice.create') }}" role="button">
                <x-icon icon="new">Novo</x-icons>
            </a>
            <hr>
            <table class="table table-striped datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


@section('scripts')
@include('_template.datatable')
    <script>
        dataTable('.datatable', {
            ajax:'{{ route('exercice.index') }}',
            columns: [
                {data: 'name'},
                {data: 'description'},
            ]
        })
    </script>
@endsection

