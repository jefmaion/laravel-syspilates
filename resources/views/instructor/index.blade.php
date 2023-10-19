@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Professores</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Professores</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="card card-outline card-{{ theme() }}">
        <div class="card-body">

            

            <a name="" id="" class="btn bg-{{ theme() }}" href="{{ route('instructor.create') }}" role="button">
                <x-icon icon="new">Novo</x-icons>
            </a>
            <hr>
            <table class="table table-striped datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Data de Cadastro</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


@section('scripts')
@include('_template.datatable')
    {{-- <script>dataTable('.datatable')</script> --}}
    <script>
        dataTable('.datatable', {
            ajax:'{{ route('instructor.index') }}',
            columns: [
                {data: 'name'},
                {data: 'phone_wpp'},
                {data: 'email'},
                {data: 'created_at'},
            ]
        })
    </script>
@endsection

