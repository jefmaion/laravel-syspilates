@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Alunos</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Alunos</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="card card-outline card-{{ theme() }}">
        <div class="card-body">

            

            <a name="" id="" class="btn bg-{{ theme() }}" href="{{ route('student.create') }}" role="button">
                <x-icon icon="new">Novo Aluno</x-icons>
            </a>

            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn bg-{{ theme() }}" data-toggle="modal" data-target="#modal-create-student">
                <x-icon icon="new">Novo Aluno</x-icons>
            </button>
            @include('student.modal.create') --}}

            <hr>
            <table class="table table-sstriped datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Tem Matrícula</th>
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
            ajax:'{{ route('student.index') }}',
            columns: [
                {data: 'name'},
                {data: 'phone_wpp'},
                {data: 'email'},
                {data: 'status'},
                {data: 'created_at'},
            ]
        })
    </script>
@endsection

