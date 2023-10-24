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
    <div class="col-md-3">
        @include('student.info')

        <div class="card">
            <div class="card-body">
                <a name="" id="" class="btn btn-outline-secondary" href="{{ route('student.index') }}" role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>
            </div>
        </div>
    </div>

    <div class="col d-flex">
        <div class="card card-{{ theme() }} card-outline card-outline-tabs flex-fill">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="modalitites-tab" data-toggle="pill" href="#modalitites"
                            role="tab" aria-controls="modalitites" aria-selected="true">
                            <i class="fa fa-tag fa-sm " aria-hidden="true"></i>
                            Modalidades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="classes-tab" data-toggle="pill" href="#classes" role="tab"
                            aria-controls="classes" aria-selected="false">
                            <i class="fas fa-calendar-check fa-sm   "></i>
                            Aulas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="evolutions-tab" data-toggle="pill" href="#evolutions" role="tab"
                            aria-controls="evolutions" aria-selected="false">
                            <i class="fas fa-calendar-check fa-sm   "></i>
                            Evoluções
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="installments-tab" data-toggle="pill" href="#installments" role="tab"
                            aria-controls="installments" aria-selected="false">
                            <i class="fas fa-dollar-sign    "></i>
                            Financeiro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-five-settings-tab" data-toggle="pill"
                            href="#custom-tabs-five-settings" role="tab" aria-controls="custom-tabs-five-settings"
                            aria-selected="false">
                            <i class="fas fa-file-signature    "></i>
                            Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="student-data-tab" data-toggle="pill" href="#student-data" role="tab"
                            aria-controls="student-data" aria-selected="false">
                            <i class="fas fa-user-edit    "></i>
                            Cadastro
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    {{-- Matriculas --}}
                    <div class="tab-pane show active" id="modalitites" role="tabpanel"
                        aria-labelledby="modalitites-tab">
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
                        @foreach($student->activeRegistrations as $registration)

                        <div
                            class="elevation-2 callout callout-{{ ($registration->daysToRenew <= 3) ? 'warning' : 'success' }}">

                            <h5>
                                <strong>
                                    <a class="text-muted"
                                        href="{{ route('student.registration.show', [$student, $registration]) }}">
                                        {{ $registration->modality->name }}
                                    </a>
                                </strong>
                                <small>
                                    <span
                                        class="badge float-right badge-pill bg-{{ ($registration->daysToRenew <= 3) ? 'warning' : 'success' }}">
                                        {{ $registration->position }}
                                    </span>
                                </small>
                            </h5>
                            <div>
                                {{ $registration->planDescription}}

                                @if($registration->duration !=0)
                                ({{ $registration->class_per_week }}x)
                                @else
                                ({{ $registration->num_classes }} Aulas)
                                @endif

                                - {{ $registration->dayClasses}}
                            </div>

                            <div>
                                De {{ $registration->start->format('d/m/Y') }} até {{
                                $registration->end->format('d/m/Y') }}
                            </div>
                        </div>

                        @endforeach
                        @else
                        <h2 class="text-center p-4 font-weight-light">Não existe modalidades ativas. </h2>
                        @endif
                    </div>

                    {{-- Aulas --}}
                    <div class="tab-pane" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                        <h5 class="border-bottom mb-3"><strong>Histórico de Aulas</strong></h5>
                        <table class="table datatable w-100 tabsle-sm table-striped">
                            <thead class="thead-light">
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
                                    <td>{{$class->modality->name }}</td>
                                    <td class="text-center" data-order="{{ $class->date->format('Y-m-d') }}">
                                        {{ $class->date->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">{{ $class->time }}</td>
                                    <td class="text-center">{{ $class->typeDescription }}</td>
                                    <td class="text-center">
                                        <x-class-status status="{{ $class->situation }}">
                                            {{ $class->statusDescription }}
                                        </x-class-status>
                                    </td>
                                    <td>
                                        <x-avatar class="" :user="$student->user" size="20px"></x-avatar> {{
                                        $class->instructor->user->shortName }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Evoluções --}}
                    <div class="tab-pane" id="evolutions" role="tabpanel" aria-labelledby="classes-tab">
                        <h5 class="border-bottom mb-3"><strong>Evoluções</strong></h5>

                        @if($student->evolutions->count())
                        <div class="timeline timeline-inverse">
                        @foreach($student->evolutions as $evol)

                        

                            <div class="time-label">
                                <span class="bg-warning text-white">
                                    {{ $evol->evolution_date->format('d/m/Y') }}
                                </span>
                            </div>


                            <div>
                                <i class="fas fa-chart-line   bg-primary "></i>
                                <div class="timeline-item">
                                    <span class="time"></strong> - <i class="far fa-clock"></i> {{ $evol->evolution_date->format('d/m/Y \à\\s\ H:i') }} </span>
                                    <h3 class="timeline-header">Evolução relatada por <strong>{{ $evol->instructor->user->shortName }}</strong></h3>
                                    <div class="timeline-body">
                                        {{ $evol->typeDescription
                                        }}
                                        {{ $evol->evolution }}
                                    </div>
                                    
                                </div>
                            </div>

                           
                            

                        @endforeach
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>
                        @else
                        <h2 class="text-center p-4 font-weight-light">Não existem evoluções cadastradas</h2>
                        @endif
                        
                    </div>
                    <div class="tab-pane" id="installments" role="tabpanel" aria-labelledby="installments-tab">
                        <h5 class="border-bottom mb-3"><strong>Mensalidades</strong></h5>
                        <table class="table datatable tables-sm w-100 table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Data Vencto</th>
                                    <th class="text-center">Data Pagto</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Status</th>
                                    <th>Descricao</th>

                                    <th class="text-center">Forma</th>


                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->installments as $installment)
                                <tr>
                                    <td class="text-center">{{ $installment->date->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ ($installment->pay_date) ?
                                        $installment->pay_date->format('d/m/Y') : '-' }}</td>
                                    <td class="text-center"><strong>{{ currency($installment->value) }}</strong></td>
                                    <td class="text-center">
                                        <x-transaction-status status="{{ $installment->statusCode }}">{{
                                            $installment->statusDescription }}</x-transaction-status>
                                    </td>
                                    <td><small>{{ $installment->description }}</small></td>
                                    <td class="text-center">{{ $installment->method->name }}</td>


                                    <td class="text-center">
                                        @if(!$installment->status)
                                        <a href="#" class="text-muted" onclick="receive({{ $installment->id }})">
                                            <i class="fas fa-hand-holding-usd    "></i>
                                        </a>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="student-data" role="tabpanel" aria-labelledby="student-data-tab">

                        <form action="{{ route('student.update', $student) }}#student-data" method="post">
                            @method('put')
                            @csrf

                            @include('commons.formuser', ['user' => $student->user])

                            <h6 class="border-bottom"><strong>3. Informações Adicionais</strong></h6>
                            <div class="row">

                                <div class="col-12  form-group">
                                    <label>Profissão</label>
                                    <x-form.input type="text" name="student[occupation]"
                                        value="{{ old('user.occupation', $student->occupation ?? '') }}" />
                                </div>


                                <div class="col-12  form-group">
                                    <label>Objetivo</label>
                                    <x-form.input type="text" name="student[objective]"
                                        value="{{ old('user.occupation', $student->objective ?? '') }}" />
                                </div>

                                <div class="col-12 form-group">
                                    <label>Observações</label>
                                    <textarea class="form-control" name="student[comments]" id="" cols="30"
                                        rows="2">{{ old('user.comments', $student->comments ?? '') }}</textarea>
                                </div>
                            </div>


                            <button type="submit" class="btn bg-{{ theme() }}">
                                <x-icon icon="save">Salvar Alterações</x-icon>
                            </button>

                            <x-modal-delete class="btn bg-danger" id="{{ $student->id }}" route="{{ route('student.destroy', $student) }}">
                                <x-icon icon="delete">Excluir Aluno</x-icon>
                            </x-modal-delete>
                        </form>

                        

                    </div>
                    <div class="tab-pane" id="custom-tabs-five-settings" role="tabpanel"
                        aria-labelledby="custom-tabs-five-settings-tab">

                            <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <div class="form-group mt-4">
                                    <input type="file" name="file" class="form-control" accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>

                                
                            </form>


                            <table class="table datatable tables-sm w-100 table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Tamanho</th>
                                        <th>Adicionado em </th>
                                        <th>Ação</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->files as $file)
                                    <tr>
                                        <td>{{ $file->origin_name }}</td>
                                        <td>{{ $file->sizeToHuman }}</td>
                                        <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <x-modal-delete  id="{{ $file->id }}" route="{{ route('files.delete', $file) }}">
                                                <x-icon icon="delete"></x-icon>
                                            </x-modal-delete>
                                        </td>
                                        
    
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

{{--
<div class="row">
    <div class="col-md-12">
        <x-user-info :student="$student">
            <x-slot name="footer">
                <a name="" id="" class="btn btn-outline-secondary" href="{{ route('student.index') }}" role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>
                <button class="btn bg-{{ theme() }} dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <x-icon icon="config"></x-icon>
                    Ações
                </button>
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
            </x-slot>
        </x-user-info>
    </div>
    <div class="col-md-12">
        <div class="card card-{{ theme() }} card-tabs">
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
                                            <h5 class="mb-0"><strong><a class="text-muted"
                                                        href="{{ route('student.registration.show', [$student, $registration]) }}">{{
                                                        $registration->modality->name }}</a></strong></h5>
                                            {{-- <a class="text-muted"
                                                href="{{ route('student.registration.show', [$student, $registration]) }}">Detalhes</a>
                                            --}}
                                            {{-- @if($registration->daysToRenew <= 3) • <a class="text-muted"
                                                href="{{ route('student.registration.renew', [$student, $registration]) }}">
                                                Renovar</a>
                                                @endif
                                                • <a class="text-muted" href="#" data-toggle="modal"
                                                    data-target="#model-cancel-{{ $registration->id }}">Cancelar</a>
                                                @include('student.registration.cancel') -}}
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
                            <thead class="thead-light">
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
                            <thead class="thead-light">
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
                                    <td>{{ $installment->category->name ?? '' }}</td>
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
</div> --}}

@include('receive.receive-include')
@endsection

@section('scripts')
@include('_template.datatable')
{{-- <script>
    dataTable('.datatable')
</script> --}}
<script>
    dataTable('.datatable')

    // $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
    //     localStorage.setItem('activeTab', $(e.target).attr('href'));
    // });

    // var activeTab = localStorage.getItem('activeTab');
    
    // if(activeTab){
    //     $('#custom-tabs-four-tab a[href="' + activeTab + '"]').tab('show');
    // }

    var tabId = window.location.hash;
    // Click the tab
    $('#custom-tabs-four-tab a[href="' + tabId + '"]').click();
</script>
@endsection