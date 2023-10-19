@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Editar Modalidade - {{ $registration->modality->name }}</strong> - {{
                        $student->user->name }}</h1>
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

    <div class="col-12">

        


        <div class="row">
            <div class="col-6">
                <div class="card card-outline card-{{theme()}}">


                    
                    <form action="{{ route('student.registration.update', [$student, $registration]) }}" method="post">
                    <div class="card-body">


                        <div class="alert bg-{{ theme() }} pb-2" role="alert">
                            <h5><strong> <i class="fa fa-exclamation-triangle fa-sm" aria-hidden="true"></i> Atenção</strong></h5>
                            <p class="m-0">Ao salvar a edição, o sistema irá excluir todas as aulas que não foram finalizadas.</p>
                        </div>

                        <h5 class="border-bottom mb-3"><strong>Informações da Matrícula</strong></h5>
                            @csrf
                            @method('PUT')
                            @include('student.registration.form')

                            
                        
                    </div>

                    <div class="card-footer text-right">
                        <a name="" id="" class="mr-4 text-muted" href="{{ route('student.registration.show', [$student, $registration]) }}" role="button">
                            <x-icon icon="back">Voltar</x-icon>
                        </a>


                        <button type="submit" class="btn bg-{{ theme() }}">
                            <x-icon icon="save"></x-icon>
                            Salvar Alterações</button>
                    </div>
                </form>
                </div>
            </div>

            {{-- <div class="col d-flex align-itemss-start">
                <div class="card flex-fill ">
                    <div class="card-header bg-pursple">
                        <h5 class=""><strong>Grade De Aulas</strong></h5>
                    </div>
                    @include('student.registration.grade')
                </div>
            </div> --}}
            
        </div>
    </div>

</div>


@endsection


@section('scripts')
@include('_template.components.select2')
@endsection
