@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Modalidades</strong> - {{
                $instructor->user->name }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('instructor.index') }}">Professores</a></li>
                <li class="breadcrumb-item"><a href="{{ route('instructor.show', $instructor) }}">{{
                    $instructor->user->shortName }}</a></li>
                <li class="breadcrumb-item active">Modalidades</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')


<div class="row">
    


    <div class="col-12">




        <div class="row">
            <div class="col-6">

                

                <div class="card card-outline card-{{ theme() }}">
                    <div class="card-body">

                        {{-- <h6 class="border-bottom"><b>Atribuir Modalidade</b></h6> --}}

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

                        <hr>

                        <table class="table table-striped datatable">
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

                        

                        
                    </div>

                    <div class="card-footer">
                        <a name="" id="" class="btn btn-outline-secondary" href="{{ route('instructor.show', $instructor) }}" role="button">
                            <x-icon icon="back">Voltar</x-icon>
                        </a>
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

        <a name="" id="" class="btn btn-outline-warning" href="{{ route('instructor.edit', $instructor) }}" role="button">
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
@include('_template.components.select2')
    {{-- <script>dataTable('.datatable')</script> --}}
    <script>
        dataTable('.datatable')
    </script>
@endsection
