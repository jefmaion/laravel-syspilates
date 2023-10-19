<div class="modal fade" id="modal-grade" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content p-2">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-alt    "></i> Grade de Aulas
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body">
                <table class="table tsable-sm table-bordered flex-fisll m-0">
                    <thead class="thead-inverse">
                        <tr class="bg-light">
                            <th>Dia</th>
                            @foreach(classWeek() as $i => $w)
                            <th class="text-center border-left">{{ $w }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach(classTime() as $k => $time)
                            <tr>
                
                                <th class="align-middle bg-light">{{ $time }}</th>
                                @foreach(classWeek() as $i => $w)
                                    <td class="align-middle border-left text-center" width="16%">
                                        @if(isset($grade[$i][$k]))
                                            @foreach($grade[$i][$k] as $name)
                                                <div class="badge badge-pill bg-{{ ($name['id'] == $student->id) ? theme() : 'light border' }}">{{ $name['name'] }}</div>
                                            @endforeach
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                
                        
                    </tbody>
                </table>
            </div>
            
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i> Fechar
                </button>
            </div>
        </div>
    </div>
</div>

