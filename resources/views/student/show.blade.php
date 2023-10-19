@extends('_template.main')

@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Ficha do Aluno</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Alunos</a></li>
                <li class="breadcrumb-item active">Ficha do Aluno</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <x-user-info :student="$student">
            <x-slot name="footer">
                <a name="" id="" class="btn btn-outline-secondary" href="{{ route('student.index') }}" role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>
                <button class="btn bg-{{ theme() }} dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-icon icon="config"></x-icon>
                    Ações
                </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="{{ route('student.edit', $student) }}">
                        <x-icon icon="edit"></x-icon> Editar Aluno
                    </a>
                    <div class="dropdown-divider"></div>
                    <x-modal-delete class="dropdown-item" id="{{ $student->id }}" route="{{ route('student.destroy', $student) }}">
                        <x-icon icon="delete">Excluir Aluno</x-icon>
                    </x-modal-delete>
                </div>
            </x-slot>
        </x-user-info>
    </div>
    <div class="col-md-12">
        <div class="card card-light card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#modality" data-toggle="tab">
                            <i class="fa fa-tag fa-sm " aria-hidden="true"></i> Modalidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline" data-toggle="tab">
                            <i class="fas fa-calendar-check fa-sm   "></i>
                            Aulas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#installments" data-toggle="tab">
                            <i class="fas fa-dollar-sign    "></i> Financeiro
                        </a>
                    </li>
                 
                </ul>
            </div>
            <div class="card-body p-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="modality">
                        <div class="p-3">
                            <h5 class="border-bottom mb-3"><strong>Modalidades</strong></h5>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('student.registration.create', $student) }}"
                                        class="btn bg-{{ theme() }} mb-3">
                                        <x-icon icon="new"></x-icon>
                                        Adicionar
                                        Modalidade
                                    </a>



                                </div>
                            </div>
                            @if($student->activeRegistrations->count() > 0)
                                <table class="table datatasble table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="15%">Modalidade</th>
                                            <th class="text-center">Plano</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Início</th>
                                            <th class="text-center">Fim</th>
                                            <th class="text-center">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($student->activeRegistrations as $registration)
                                        <tr>
                                            <td class="align-middle" scope="row">
                                                <h5 class="mb-0"><strong><a class="text-muted" href="{{ route('student.registration.show', [$student, $registration]) }}">{{ $registration->modality->name }}</a></strong></h5>
                                                {{-- <a class="text-muted" href="{{ route('student.registration.show', [$student, $registration]) }}">Detalhes</a> --}}
                                                {{-- @if($registration->daysToRenew <= 3) • <a class="text-muted"
                                                    href="{{ route('student.registration.renew', [$student, $registration]) }}">
                                                    Renovar</a>
                                                @endif
                                                • <a class="text-muted" href="#" data-toggle="modal"
                                                    data-target="#model-cancel-{{ $registration->id }}">Cancelar</a>
                                                @include('student.registration.cancel') --}}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ $registration->planDescription}}

                                                @if($registration->duration !=0)
                                                ({{ $registration->class_per_week }}x)
                                                @else
                                                ({{ $registration->num_classes }} Aulas)
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <h6>
                                                    <span
                                                        class="badge badge-pill bg-{{ ($registration->daysToRenew <= 3) ? 'warning' : theme() }}">
                                                        {{ $registration->position }}
                                                    </span>
                                                </h6>
                                            </td>

                                            <td class="align-middle text-center">{{ $registration->start->format('d/m/Y') }}
                                            </td>
                                            <td class="align-middle text-center">{{ $registration->end->format('d/m/Y') }}
                                            </td>
                                            <td class="align-middle text-center">{{ currency($registration->value) }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <h2 class="text-center p-4 font-weight-light">Não existe modalidades ativas. </h2>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane  p-3" id="timeline">
                        <h5 class="border-bottom mb-3"><strong>Histórico de Aulas</strong></h5>
                        <table class="table datatable w-100 tabsle-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Modalidade</th>
                                    <th class="text-center">Data</th>
                                    <th class="text-center">Hora</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Status</th>
                                    <th>Instrutor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->classes as $class)
                                <tr>
                                    <td width="10%">{{$class->modality->name }}</td>
                                    <td width="7%" class="text-center" data-sort="{{ $class->date }}">{{
                                        $class->date->format('d/m/Y') }}</td>
                                    <td width="7%" class="text-center">{{ $class->time }}</td>

                                    <td width="9%" class="text-center">{{ $class->typeDescription }}</td>
                                    <td width="9%" class="text-center">
                                        <x-class-status status="{{ $class->situation }}">
                                            {{ $class->statusDescription }}
                                        </x-class-status>

                                    </td>
                                    <td>
                                        <x-avatar class="" :user="$student->user" size="20px"></x-avatar> {{
                                        $class->instructor->user->name }}
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   
                    <div class="tab-pane  p-3" id="installments">
                        <h5 class="border-bottom mb-3"><strong>Mensalidades</strong></h5>
                        <table class="table datatable tables-sm w-100 table-striped">
                            <thead>
                                <tr>
                                    <th>Data Vencto</th>
                                    <th>Descricao</th>
                                    <th>Valor</th>
                                    <th>Categoria</th>
                                    <th>Forma</th>
                                    <th>Status</th>
                                    <th>Data Pagto</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->installments as $installment)
                                <tr>
                                    <td>{{ $installment->date->format('d/m/Y') }}</td>
                                    <td>{{ $installment->description }}</td>
                                    <td>{{ currency($installment->value) }}</td>
                                    <td>{{ $installment->category->name }}</td>
                                    <td>{{ $installment->method->name }}</td>
                                    <td>
                                        <x-transaction-status status="{{ $installment->statusCode }}">{{
                                            $installment->statusDescription }}</x-transaction-status>
                                    </td>
                                    <td>{{ $installment->pay_date ?? '-' }}</td>
                                    <td><a href="#" onclick="receive({{ $installment->id }})">Receber</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('receive.receive-include')
@endsection

@section('scripts')
@include('_template.datatable')
{{-- <script>
    dataTable('.datatable')
</script> --}}
<script>
    dataTable('.datatable')
</script>
@endsection