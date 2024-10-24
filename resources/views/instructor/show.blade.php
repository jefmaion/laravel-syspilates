@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Ficha do Professor</strong> - {{
                $instructor->user->name }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('instructor.index') }}">Professores</a></li>
                <li class="breadcrumb-item active">Ficha do Professor</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')




<div class="row">
    <div class="col-md-3">
        <div class="card card-{{ theme() }} card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <x-avatar class="img-bordered-sm" :user="$instructor->user" size="64px"></x-avatar>
                </div>
                <h3 class="profile-username text-center">{{ $instructor->user->shortName }}</h3>
                <p class="text-muted text-center">{{ $instructor->occupation }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Status</b> <a class="float-right"><span class="badge badge-pill badge-success">Ativo</span></a>
                    </li>

                    <li class="list-group-item">
                        <b>Cadastrado em:</b> <span class="float-right">{{ $instructor->created_at->format('d/m/Y H:i:s') }}</span>
                    </li>

                </ul>


                {{-- <ul class="list-group list-group-unbordered mb-3">
                    @foreach($instructor->modalities as $modality)
                    <li class="list-group-item">
                        <b>{{ $modality->name }}</b> <a class="float-right"> {{ $modality->pivot->percentual }}</a>
                    </li>
                    @endforeach
                </ul> --}}
            </div>
            <div class="card-footer">
                <a name="" id="" class="btn btn-outline-secondary" href="{{ route('instructor.index') }}" role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>

                <button class="btn bg-{{ theme() }} dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <x-icon icon="config"></x-icon>
                    Ações
                </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="{{ route('instructor.edit', $instructor) }}">
                        <x-icon icon="edit"></x-icon> Editar Professor
                    </a>
                    <a class="dropdown-item" href="{{ route('instructor.modality.index', $instructor) }}">
                        <x-icon icon="edit">Modalidades</x-icon>
                    </a>
                    <div class="dropdown-divider"></div>
                    <x-modal-delete class="dropdown-item" id="{{ $instructor->id }}"
                        route="{{ route('instructor.destroy', $instructor) }}">
                        <x-icon icon="delete">Excluir</x-icon>
                    </x-modal-delete>
                </div>

            </div>

        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#modality" data-toggle="tab">
                            <i class="fas fa-calendar-alt    "></i>
                            Histórico de Aulas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#modalities" data-toggle="tab">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            Modalidades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline" data-toggle="tab">
                            <i class="fas fa-dollar-sign    "></i>
                            Financeiro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="fas fa-user-edit    "></i>
                            Dados Cadastrais
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#access" data-toggle="tab">
                            <i class="fas fa-user-edit    "></i>
                            Acesso ao Sistema
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="modality">



                        <table class="table table-striped datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Modalidade</th>
                                    <th>Aluno</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($instructor->classes as $class)
                                <tr>
                                    <td>{{ $class->date->format('d/m/Y') }}</td>
                                    <td>{{ $class->time }}</td>

                                    <td>{{ $class->modality->name }}</td>
                                    <td>
                                        {{-- <x-avatar class="" :user="$class->student->user ?? null" size="20px">
                                        </x-avatar> --}}
                                        {{ $class->studentName ?? null }}
                                    </td>
                                    <td>
                                        <x-class-status status="{{ $class->situation }}">
                                            {{ $class->statusDescription }}
                                        </x-class-status>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane" id="modalities">

                        <table class="table table-striped datatable w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Modalidade</th>
                                    <th>Percentual</th>
                                    <th>Calcula na Falta</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($instructor->modalities as $modality)
                                    <tr>
                                        <td><strong>{{ $modality->name }}</strong></td>
                                        <td>{{ $modality->pivot->percentual }}</td>
                                        <td>{{ $modality->pivot->absense }}</td>
                                        <td>
                                            <x-modal-delete class="btn-sm text-muted" id="{{ $instructor->id }}" route="{{ route('instructor.modality.destroy', [$instructor, $modality->id]) }}">
                                                <x-icon icon="delete"></x-icon>
                                            </x-modal-delete>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <form action="{{ route('instructor.modality.store', $instructor) }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-4  form-group">
                                    <label>Modalidade</label>
                                    <x-form.select name="modality_id" class="select2 w-100" value="" :options="$modalities" />
                                </div>

                                <div class="col  form-group">
                                    <label>Percentual</label>
                                    <x-form.input type="text" name="percentual" value="" />
                                </div>

                                <div class="col  form-group">
                                    <label>Calcular na Falta?</label>
                                    <x-form.select name="calc_on_absense" class="select2 w-100"  :options="[1 => 'Sim', 0 => 'Não']" />
                                </div>

                                <div class="col d-flex align-items-center">

                                    {{--  --}}
                                    <button type="submit" class="btn bg-{{ theme() }} btn-block">
                                    <i class="fas fa-check-double    "></i> Atribuir Modalidade</button>
                                </div>


                            </div>
                        </form>



                    </div>

                    <div class="tab-pane" id="timeline">

                        <div class="timeline timeline-inverse">

                            <div class="time-label">
                                <span class="bg-danger">
                                    10 Feb. 2014
                                </span>
                            </div>


                            <div>
                                <i class="fas fa-envelope bg-primary"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>


                            <div>
                                <i class="fas fa-user bg-info"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your
                                        friend request
                                    </h3>
                                </div>
                            </div>


                            <div>
                                <i class="fas fa-comments bg-warning"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                    </div>
                                </div>
                            </div>


                            <div class="time-label">
                                <span class="bg-success">
                                    3 Jan. 2014
                                </span>
                            </div>


                            <div>
                                <i class="fas fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                    <div class="timeline-body">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="settings">
                        <form action="{{ route('instructor.update', $instructor) }}" method="post">
                            @method('put')
                            @csrf
                            @include('commons.formuser', ['user' => $instructor->user])

                            <h6 class="my-3 border-bottom"><strong>3. Informações Adicionais</strong></h6>
                            <div class="row">

                                <div class="col-6  form-group">
                                    <label>Formação</label>
                                    <x-form.input type="text" name="instructor[occupation]"
                                        value="{{ old('instructor.occupation', $instructor->occupation ?? '') }}" />
                                </div>

                                <div class="col-6  form-group">
                                    <label>Documento da Categoria (CREF/CREFITO)</label>
                                    <x-form.input type="text" name="instructor[document]"
                                        value="{{ old('instructor.document', $instructor->document ?? '') }}" />
                                </div>

                                <div class="col-12 form-group">
                                    <label>Observações</label>
                                    <textarea class="form-control" name="instructor[comments]" id="" cols="30"
                                        rows="3">{{ old('instructor.comments', $instructor->comments ?? '') }}</textarea>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>

                    <div class="tab-pane" id="access">



                        <form action="{{ route('instructor.password', $instructor) }}" method="post">

                            @csrf

                            <button type="submit" class="btn btn-primary">Reenviar Senha de Acesso</button>


                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>


{{--

<div class="card card-outline-secondary">
    <div class="card-body">

        <h4><strong>{{ $instructor->user->name }}</strong></h4>
        <div>Cadastrado {{ $instructor->created_at->diffForHumans() }}</div>
        <address>
            {{ $instructor->user->address }} {{ $instructor->user->number }} {{ $instructor->user->complement }}<br>
            {{ $instructor->user->district }}, {{ $instructor->user->city }} {{ $instructor->user->zipcode }}<br>
            Phone: {{ $instructor->user->phone_wpp }} | {{ $instructor->user->phone2 }}<br>
            Email: {{ $instructor->user->email }}
        </address>

        <hr>


        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                    href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                    aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                    href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                    aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill"
                    href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages"
                    aria-selected="false">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                    href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings"
                    aria-selected="false">Settings</a>
            </li>
        </ul>

        <div class="tab-content" id="custom-content-below-tabContent">
            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
                aria-labelledby="custom-content-below-home-tab">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie,
                sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis
                auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper
                felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim
                sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id
                tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit,
                condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
            </div>
            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                aria-labelledby="custom-content-below-profile-tab">
                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula
                tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas
                sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus.
                Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>
            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel"
                aria-labelledby="custom-content-below-messages-tab">
                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi
                placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique
                nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna
                a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus
                efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex
                vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget
                sem eu risus tincidunt eleifend ac ornare magna.
            </div>
            <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel"
                aria-labelledby="custom-content-below-settings-tab">
                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare
                sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie
                tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec
                pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl
                commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
            </div>
        </div>







    </div>

    <div class="card-footer">
        <a name="" id="" class="btn btn-outline-secondary" href="{{ route('instructor.index') }}" role="button">
            <x-icon icon="back">Voltar</x-icon>
        </a>

        <a name="" id="" class="btn btn-outline-warning" href="{{ route('instructor.edit', $instructor) }}"
            role="button">
            <x-icon icon="edit">Editar</x-icon>
        </a>


        <x-modal-delete id="{{ $instructor->id }}" route="{{ route('instructor.destroy', $instructor) }}">
            <x-icon icon="delete">Excluir</x-icon>
        </x-modal-delete>
    </div>
</div> --}}
@endsection

@section('scripts')
@include('_template.datatable')
{{-- <script>
    dataTable('.datatable')
</script> --}}
<script>
    dataTable('.datatable')
</script>
<script>
   var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
}
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
});


</script>
@endsection
