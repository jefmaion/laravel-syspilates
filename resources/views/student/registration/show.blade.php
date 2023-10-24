@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <x-page-title>
                <i class="fa fa-users fa-sm" aria-hidden="true"></i>
                <strong>Detalhes da Modalidade</strong> - {{$student->user->name }}
            </x-page-title>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Alunos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.show', $student) }}">{{ $student->user->shortName
                        }}</a></li>
                <li class="breadcrumb-item active">Modalidade - {{ $registration->modality->name }} </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')


<div class="row">
    
    <div class="col-md-3">
        @include('student.info')
    </div>



    <div class="col-9 d-flex">

        <div class="row">
            <div class="col-12 d-flex">
                <div class="card flex-fill card-outline card-{{ theme() }}">
                    <div class="card-header">
                        <strong>{{ $registration->modality->name }} - Detalhes da matrícula</strong>
                    </div>
                    <div class="card-body">

                    

                        <div class="row">
                            <div class="col">


                              <h3>
                                    <strong>{{ $registration->modality->name }}</strong>
                                </h3>



                                <dl class="row mb-0">

                                    <dt class="col-sm-2">Status</dt>
                                    <dd class="col-sm-10">
                                        <span
                                            class="badge badge-pill badge-{{ ($registration->daysToRenew <= 3) ? 'warning' : 'success' }}">
                                            {{ $registration->position }}
                                        </span>
                                    </dd>

                                    <dt class="col-sm-2">Plano</dt>
                                    <dd class="col-sm-10">{{ $registration->planDescription }} {{ $registration->duration}}x</dd>

                                    <dt class="col-sm-2">Valor</dt>
                                    <dd class="col-sm-10">R$ {{ currency($registration->value) }}</dd>

                                    <dt class="col-sm-2">Vigência</dt>
                                    <dd class="col-sm-10">{{ $registration->start->format('d/m/Y') }} até {{ $registration->end->format('d/m/Y') }}</dd>

                                    <dt class="col-sm-2">Aulas</dt>
                                    <dd class="col-sm-10">{{ $registration->dayClasses }}</dd>
                                </dl>

                            </div>
                            <div class="col">

                                <div class="row">
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h1>{{ $resume->total }}</h1>
                                                Aulas
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h1>{{ $resume->presences }}</h1>
                                                Presenças
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h1>{{ $resume->absenses }}</h1>
                                                Faltas
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h1>{{ $resume->repositions }}</h1>
                                                Reposições
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div>

                            {{-- <a name="" id="" class="btn btn-outline-secondary mr-2"
                                href="{{ route('student.show', $student) }}" role="button">
                                <x-icon icon="back">Voltar</x-icon>
                            </a> --}}

                        
                            <button class="btn bg-{{ theme() }} dropdown-toggle " type="button" id="triggerId"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <x-icon icon="config"></x-icon>
                                Ações
                            </button>

                            <div class="dropdown-menu" aria-labelledby="triggerId">

                                <a class="dropdown-item"
                                    href="{{ route('student.registration.class.create', [$student, $registration]) }}">
                                    <x-icon icon="new"></x-icon> Adicionar Aula
                                </a>

                                <a class="dropdown-item"
                                    href="{{ route('student.registration.edit', [$student, $registration]) }}">
                                    <x-icon icon="edit"></x-icon> Editar Modalidade
                                </a>

                                

                                <a class="dropdown-item"
                                    href="{{ route('student.registration.renew', [$student, $registration]) }}">
                                    <i class="fas fa-sync fas-sm    "></i> Renovar Modalidade
                                </a>

                                <a class="dropdown-item"
                                        href="#" data-toggle="modal"
                                        data-target="#model-cancel-{{ $registration->id }}">
                                    <i class="fas fa-times-circle    "></i> Cancelar Modalidade
                                </a>

                                <div class="dropdown-divider"></div>

                                <x-modal-delete class="dropdown-item" id="{{ $student->id }}"
                                    route="{{ route('student.registration.destroy', [$student, $registration]) }}">
                                    <x-icon icon="delete">Excluir Modalidade</x-icon>
                                </x-modal-delete>
                            </div>
                        

                            @include('student.registration.cancel')

                        </div>

                        <br><br>

                        <h5 class="border-bottom mb-3"><strong>Aulas</strong></h5>

                        {{-- <a name="" id="" class="btn bg-purple btn-sm mb-3"
                            href="{{ route('student.registration.class.create', [$student, $registration]) }}"
                            role="button">
                            <x-icon icon="new"></x-icon> Adicionar Aula
                        </a> --}}
                        <table class="table datatable table-ssm table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Dia</th>
                                    <th>Hora</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Instrutor</th>
                                    <th>Evolução</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($classes))
                                @foreach($classes as $class)
                                <tr>
                                    <td width="5%">{{ $class->date->format('d/m/Y') }}</td>
                                    <td width="5%">{{ $class->time }}</td>
                                    <td width="10%">{{ $class->typeDescription }}</td>
                                    <td width="10%">

                                        <x-class-status status="{{ $class->situation }}">
                                            {{ $class->statusDescription }}
                                        </x-class-status>
                                    </td>
                                    <td>
                                        <x-avatar class="" :user="$class->instructor->user" size="20px"></x-avatar> {{
                                        $class->instructor->user->name }}
                                    </td>
                                    <td>
                                        @if($class->evolution)
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('student.registration.class.edit', [$student, $registration, $class]) }}"
                                            class="mr-2 text-muted">
                                            <i class="fas fa-pencil-alt    "></i>
                                        </a>


                                        <x-modal-delete class="text-muted" id="class-{{ $class->id }}"
                                            route="{{ route('student.registration.class.destroy', [$student, $registration, $class]) }}">
                                            <i class="fas fa-trash-alt    "></i>
                                        </x-modal-delete>
                                    </td>

                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>



                    </div>

                    <div class="card-footer d-flex">

                       
                                                    
                        {{--



                        <a name="" id="" class="btn btn-outline-secondary"
                            href="{{ route('student.registration.edit', [$student, $registration]) }}" role="button">
                            <x-icon icon="back">Editar</x-icon>
                        </a> --}}

                        {{-- <x-modal-delete class="btn btn-outline-danger" id="{{ $student->id }}"
                            route="{{ route('student.registration.destroy', [$student, $registration]) }}">
                            <x-icon icon="delete">Excluir Modalidade</x-icon>
                        </x-modal-delete> --}}

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <a class="dropdown-item" href="{{ route('student.edit', $student) }}">
                                <x-icon icon="edit"></x-icon> Editar Aluno
                            </a>
                            <div class="dropdown-divider"></div>

                            <x-modal-delete class="dropdown-item" id="{{ $student->id }}"
                                route="{{ route('student.destroy', $student) }}">
                                <x-icon icon="delete">Excluir Aluno</x-icon>
                            </x-modal-delete>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@include('_template.datatable')
<script>
    dataTable('.datatable')
</script>
@endsection