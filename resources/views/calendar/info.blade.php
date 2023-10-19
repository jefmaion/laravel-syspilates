<div class="row mb-4">
    <div class="col-auto">
        @if(!$class->isExperimental)
            <x-avatar class="elevation-2" :user="$class->student->user" size="64px"></x-avatar>
        @endif
    </div>

    <div class="col">
     
        <h5 class="mb-1">
            @if(!$class->isExperimental)
                <a href="{{ route('student.show', $class->student) }}"><strong>{{ $class->student->user->shortName }}</strong></a>
                <span class="text-muted">
                    <small>
                        @if($class->registration->comments)
                         <small>({{ $class->registration->comments }})</small>
                        @endif
                    </small>
                </span>
            @else
                <strong>{{ $class->studentName }}</strong>
                
            @endif
            
            
        </h5>

        <div>


            

            <span class="text-muted mt-1">
                <i class="fas fa-phone    "></i>
                {{ $class->studentPhone }}
            </span>

            <span class="mx-2">|</span>

            <span class="text-muted mt-1">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                {{ $class->modality->name }} 
            </span>

            <span class="mx-2">|</span>

            {{-- <span class="text-muted mt-1">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                {{ $class->date->format('d/m/Y') }} 
            </span>
    
            <span class="mx-2">|</span> --}}

            <span class="text-muted mt-1">
                <i class="far fa-clock"></i>
                {{ $class->time }}
            </span>
    
            <span class="mx-2">|</span>
    
            <span class="text-muted mt-1">
                <x-avatar class="elevation-2" :user="$class->instructor->user" size="20px"></x-avatar>
                {{ $class->instructor->user->shortName }}
            </span>
        </div>

        <div class="text-muted">
            
        </div>

        <h6 class="mt-2">

            <span class="badge badge-pill badge-light border">{{ $class->typeDescription }}</span>
           
            <x-class-status status="{{ $class->situation }}">
                {{ $class->statusDescription }}
            </x-class-status>

        @if(!$class->isExperimental)    
            @if($class->parent)
            <span class="badge badge-pill badge-secondary">
                Reposição do dia {{ $class->parent->date->format('d/m/Y') }}
            </span>
            @endif

            @if($class->lastReposition)
            <span class="badge badge-pill badge-secondary">
                Reposição em {{ $class->lastReposition->date->format('d/m/Y') }}
            </span>
            @endif
        @endif
        </h6>

      
      

        


    </div>

    





</div>
