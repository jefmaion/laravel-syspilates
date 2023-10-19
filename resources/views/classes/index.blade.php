@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Modalidades</strong></h1>
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
            <hr>

            <table class="table table-striped datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Modalidade</th>
                        <th>Tipo</th>
                        <th>Aluno</th>
                        <th>Professor</th>
                        <th>Status</th>
                        <th>Ações</th>
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
            ajax: {
                url:'{{ route('class.index') }}',
                error: function (jqXHR, textStatus, errorThrown) {
                    showAlert('Houve um erro ao carregar os dados!', 'error')
                }
            },
            columns: [
                {data: 'date'},
                {data: 'time'},
                {data: 'modality'},
                {data: 'type'},
                {data: 'student'},
                {data: 'instructor'},
                {data: 'status'},
                {data: 'actions'},
            ]
        })
    </script>
@endsection

