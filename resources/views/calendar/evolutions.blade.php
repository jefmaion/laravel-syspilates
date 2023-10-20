<div class="card-comments bg-transparent" style="height:300px; overflow:auto; line-height: 2em">
@foreach($class->student->evolutions as $evol)
<div class="card-comment py-3 {{ ($class->id == $evol->id) ? 'font-weight-bold' : '' }}">

    {{-- <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image"> --}}
    <x-avatar class="img-circle img-sm" :user="$evol->instructor->user" size="20px"></x-avatar>
    <div class="comment-text">
        <span class="username">
            {{ $evol->instructor->user->shortName }} - {{ $evol->evolution_date->format('d/m/Y') }}</strong> - {{ $evol->typeDescription }}
        </span>

       
        
            {{ $evol->evolution }}
       
    </div>
    
</div>

@endforeach
</div>
{{-- 
<div class="timeline timeline-inverse" style="max-height:300px; overflow:auto">

    @foreach($class->student->evolutions as $evol)
    <div class="time-label">
        <span class="bg-custom-primary text-white">
            {{ $evol->date->format('d M y') }}
        </span>
    </div>


    <div>
        <div class="timeline-item border-0 bg-transparent">
            <span class="time"><i class="far fa-clock"></i> {{ $evol->evolution_date->format('d/m/Y H:i:s') }}</span>
            <p>
                <strong>{{ $evol->instructor->user->shortName }}</strong> relatou:
            </p>
            <div class="timeline-body">
                {{ $evol->evolution }}
            </div>

        </div>
    </div>
    @endforeach


</div> --}}