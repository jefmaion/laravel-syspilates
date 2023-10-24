@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Renovar Modalidade - {{ $registration->modality->name }}</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Professores</a></li>
                        <li class="breadcrumb-item"><a href="#">{{
                            $student->user->shortName }}</a></li>
                        <li class="breadcrumb-item active">Modalidades</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')


<div class="row">

    <div class="col-md-3">
        @include('student.info')
    </div>

    <div class="col">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-{{ theme() }}">
                    <form action="{{ route('student.registration.renew.store', [$student, $id]) }}" method="post">
                    <div class="card-body">
                        
                            @csrf

                          @include('student.registration.form')
                            
                        
                    </div>
                    <div class="card-footer text-right">
                        <a name="" id="" class="mr-4 text-muted" href="{{ route('student.show', $student) }}" role="button">
                            <x-icon icon="back">Voltar</x-icon>
                        </a>

                        <button type="submit" class="btn bg-{{ theme() }}">
                            <x-icon icon="save"></x-icon>
                            Renovar Modalidade</button>
                    </div>
                </form>
                </div>
            </div>

            
            
        </div>
    </div>

</div>

@include('student.registration.grade')
@endsection


@section('scripts')
@include('_template.datatable')
@include('_template.components.select2')
    {{-- <script>dataTable('.datatable')</script> --}}
    <script>
        dataTable('.datatable')
    </script>
@endsection
