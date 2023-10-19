<div class="card card-outline card-{{ theme() }}">
    <div class="card-body p-3">
        <div class="row">
            <div class="col-auto"><x-avatar class="elevation-2" :user="$student->user" size="64px"></x-avatar></div>
            <div class="col">
                <h5 class="m-0">{{ $student->user->name }}
                
                    <small class="text-muted m-0 float-right">
                        <small>Cadastrado em {{ $student->created_at->format('d/m/Y') }}</small>
                    </small>
                </h5>
                
                <div class="mt-1 text-muted">
                    <p class="m-0"><i class="fa fa-phone fa-sm" aria-hidden="true"></i> {{ $student->user->phone_wpp }}</p>
                    @if(!empty($student->user->email))
                    <p class="m-0"><i class="fa fa-envelope fa-sm" aria-hidden="true"></i> {{ $student->user->email }}</p>
                    @endif
                </div>
            </div>
        </div>
        

        {{ $slot}}
    </div>

    @if(isset($footer))

    <div class="card-footer">
        {{ $footer }}
    </div>

    @endif
</div>