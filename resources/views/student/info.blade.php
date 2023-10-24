<div class="card card-{{ theme() }} card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <x-avatar class="profile-user-img img-fluid img-circle" :user="$student->user" sizes="64px"></x-avatar>
            
        </div>
        <h3 class="profile-username text-center">{{ $student->user->name }}</h3>
      
        <p class="text-muted text-center">
            {{ $student->user->age }} anos • 
            {{ $student->user->genderDescription }} •
        </p>
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Aluno desde:</b> <span class="float-right"> {{ $student->created_at->format('d/m/Y H:i') }}</span>
            </li>

            <li class="list-group-item">
                <b>Aulas</b> <span class="float-right">{{ $resume->total ?? 0 }}</span>
            </li>
            <li class="list-group-item">
                <b>Presenças</b> <span class="float-right">{{ $resume->presences ?? 0}}</span>
            </li>
            <li class="list-group-item">
                <b>Faltas</b> <span class="float-right">{{ $resume->absenses ?? 0 }}</span>
            </li>
            <li class="list-group-item">
                <b>Reposições</b> <span class="float-right">{{ $resume->repositions ?? 0 }}</span>
            </li>
        </ul>
    </div>

</div>

<div class="card d-flex">
    <div class="card-header">
        <h3 class="card-title">Mais Informações</h3>
    </div>

    <div class="card-body  flex-fill">

        
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
        <p class="text-muted">{{ $student->user->fullAddress }}</p>
        <hr>
        
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Contatos</strong>
        <p class="text-muted">

            @if($student->user->phone_wpp)
            {{ $student->user->phone_wpp }} <br>
            @endif

            @if($student->user->phone)
            {{ $student->user->phone }} <br>
            @endif

            @if($student->user->email)
            {{ $student->user->email }}
            @endif
        </p>
  
        <hr>
        <strong><i class="fas fa-pencil-alt mr-1"></i> Objetivo</strong>
        <p class="text-muted">
           {{ $student->objective }}
        </p>
        
    </div>

</div>