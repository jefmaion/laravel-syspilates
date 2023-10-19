{{-- <div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <x-avatar class="img-bordered-sm" :user="$student->user" size="64px"></x-avatar>
        </div>
        <h3 class="profile-username text-center">{{ $student->user->shortName }}</h3>
        <p class="text-muted text-center">Software Engineer</p>
        
        
    </div>
    <div class="card-footer">
        <a name="" id="" class="btn btn-outline-secondary" href="{{ route('student.index') }}" role="button">
            <x-icon icon="back">Voltar</x-icon>
        </a>

        <a name="" id="" class="btn btn-outline-warning" href="{{ route('student.edit', $student) }}" role="button">
            <x-icon icon="edit">Editar</x-icon>
        </a>


        <x-modal-delete id="{{ $student->id }}" route="{{ route('student.destroy', $student) }}">
            <x-icon icon="delete">Excluir</x-icon>
        </x-modal-delete>
    </div>

</div> --}}

<div class="card card-outline card-{{ theme() }}">
    <div class="card-body p-3">
        <div class="row">
            <div class="col-auto"><x-avatar class="elevation-2" :user="$student->user" size="64px"></x-avatar></div>
            <div class="col">
                <h5 class="m-0">{{ $student->user->name }}
                
                    <small class="text-muted m-0 float-right">Cadastrado em {{ $student->created_at->format('d/m/Y') }}</small>
                </h5>
                
                <p class="mt-2"><i class="fa fa-phone fa-sm" aria-hidden="true"></i> {{ $student->user->phone_wpp }}</p>
            </div>
        </div>
        
    </div>
</div>

{{-- 
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Informações Adicionais</h3>
    </div>

    <div class="card-body">

        <strong><i class="fas fa-book mr-1"></i> Contatos</strong>
        <address class="text-muted">
            Phone: {{ $student->user->phone_wpp }} | {{ $student->user->phone2 }}<br>
            Email: {{ $student->user->email }}
        </address>
        <hr>
        <strong><i class="fas fa-book mr-1"></i> Endereço</strong>
        <address class="text-muted">
            {{ $student->user->address }} {{ $student->user->number }} {{ $student->user->complement }}<br>
            {{ $student->user->district }}, {{ $student->user->city }} {{ $student->user->zipcode }}<br>
        </address>
        <hr>
        <strong><i class="fas fa-book mr-1"></i> Medicamentos</strong>
        <p class="text-muted">
            {{ $student->medicines }}
        </p>
        
    </div>

</div> --}}