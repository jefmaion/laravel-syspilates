@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Matrículas Correntes</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Modalidades</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="card card-outline card-{{ theme() }}">
        <div class="card-body">


            <table class="table table-striped datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Status</th>
                        <th>Aluno</th>
                        <th>Modalidade</th>
                        <th>Plano</th>
                        <th>Valor</th>
                        <th>Início</th>
                        <th>Fim</th>
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
            ajax:'{{ route('registration.index') }}',
            columns: [
                {data: 'status'},
                {data: 'name'},
                {data: 'modality'},
                {data: 'plan'},
                {data: 'value'},
                {data: 'start'},
                {data: 'end'},
                
            ]
        })
    </script>
@endsection

