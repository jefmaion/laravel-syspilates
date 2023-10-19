@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-tag" aria-hidden="true"></i> <strong>Contas a Receber</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Contas a Receber</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-9">
        <div class="card card-outline card-{{ theme() }}">

            <div class="card-header">

                <div class="row">
                    <div class="col-8">

                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                        Ações
                                    </button>
                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                <h6 class="dropdown-header">Com Marcados</h6>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-confirm-receive">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Receber

                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-confirm-delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Excluir
                                </a>

                            </div>

                        <a name="" id="" class="btn bg-{{ theme() }}" href="{{ route('receive.create') }}" role="button">
                            <x-icon icon="new">Novo Lançamento</x-icons>
                        </a>
                        
                    </div>
                    <div class="col">
                        <form class="form-inline d-flex justify-content-between" action="{{ route('receive.index') }}"
                            method="get">
                            <x-form.input type="date" class="input" name="from"
                                value="{{ request()->get('from') ?? date('Y-m-01')  }}" />
                            <x-form.input type="date" class="input" name="to"
                                value="{{ request()->get('to') ?? date('Y-m-t')  }}" />
                            <button type="submit" class="btn bg-{{ theme() }}">
                                <i class="fa fa-filter fa-sm" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>




            </div>
            <div class="card-body">

                <table class="table table-striped tablewW-sm datatable">
                    <thead class="thead-light">
                        <tr>
                            <th width="2%">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="check-all">
                                    <label for="check-all" class="custom-control-label"></label>
                                </div>

                            </th>
                            <th width="10%">Data Vencto</th>
                            <th width="20%">Descricao</th>
                            <th>Valor</th>
                            <th width="15%">Categoria</th>
                            <th>Forma</th>
                            <th>Status</th>
                            <th>Data Pagto</th>
                            <th>Ações</th>
                        </tr>

                      
                    </thead>
                    <tfoot class="thead-light">
                        <tr>
                            <th>
                            

                            </th>
                            <th>Data Vencto</th>
                            <th>Descricao</th>
                            <th>Valor</th>
                            <th>Categoria</th>
                            <th>Forma</th>
                            <th>Status</th>
                            <th>Data Pagto</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                   
                </table>
            </div>
        </div>
    </div>

    <div class="col-3 ">

        <div class="d-fslex">
            <div class="small-box bg-white flex-fill">
                <div class="inner">
                    <h3>R$ {{ currency($resume->to_receive) }}</h3>
                    <p>A receber</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-area    "></i>
                </div>
            </div>
    
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>R$ {{ currency($resume->pay_today) }}</h3>
                    <p>Recebr Hoje</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-area  text-warning  "></i>
                </div>
            </div>
    
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>R$ {{ currency($resume->received) }}</h3>
                    <p>Recebido</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-area  text-olive  "></i>
                </div>
            </div>
    
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>R$ {{ currency($resume->late) }}</h3>
                    <p>Atrasado</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-area  text-danger  "></i>
                </div>
            </div>
    
            <hr>
    
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>R$ {{ currency($resume->total) }}</h3>
                    <p>Total</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-area    "></i>
                </div>
            </div>
        </div>
        



        
    </div>
</div>


<div id="modal-container"></div>

<!-- Modal -->
<div class="modal fade" id="modal-confirm-receive" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header bg-{{ theme() }}">
                <h5 class="modal-title"><i class="fa fa-check-circle" aria-hidden="true"></i> <strong>Receber</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body text-center">
                <h4 class="pb-4 font-weight-normal">Deseja receber todos os lançamentos selecionados?</h4>
                <p class="text-muted">Para contas atrasadas, os cálculos de juros serão aplicados automaticamente!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <x-icon icon="close"></x-icon> Fechar
                </button>
                <button type="button" class="btn bg-{{ theme() }}" onclick="receiveAll()">
                    <x-icon icon="save"></x-icon>
                    Receber
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Deseja excluir os lançamentos selecionados?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="deleteAll()">Sim</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

@include('_template.datatable')
<script>



    dataTable('.datatable', {
        // ordering: false,
        pageLength: 10,
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;

                if(column[0] > 0) {

                    // placeholder = column.header().innerText
                
                    // var input = $('<input class="form-control form-control-sm" placeholder="'+placeholder+'" />')
                    //             .appendTo($(column.footer()).empty())
                    //             .on('keyup', function() {
                    //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    //                 var val = $(this).val();
                    //                 console.log(val)
                    //                 column.search(val).draw();
                    //             })

                    var select = $('<select class="form-control form-control-sm input-sm select2 w-100"><option value="">(Tudo)</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        var val = $(this).val();
                        console.log(val)
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                    exists = [];
                    column.data().unique().sort().each(function(d, j) {
                        or = d;
                        d = d.replace( /(<([^>]+)>)/ig, '');
                        d = d.trim();
                        if(!exists.includes(d)) {
                            exists.push(d)
                        }
                    });

                    exists.sort()

                    $(exists).each(function (index, element) {
                        select.append('<option value="' + element + '">' + element + '</option>');
                    });

                }   
            });

            
        },
    //     initComplete: function () {
    //     this.api()
    //         .columns()
    //         .every(function () {
    //             let column = this;
    //             let title = column.footer().textContent;

    //             if(column[0] > 0) {
 
    //             // Create input element
    //             let input = document.createElement('input');
    //             input.placeholder = title;
    //             column.footer().replaceChildren(input);
 
    //             // Event listener for user input
    //             input.addEventListener('keyup', () => {
    //                 if (column.search() !== this.value) {
    //                     column.search(input.value).draw();
    //                 }
    //             });
    //         }
    //         });
    // },
            ajax:'{{ route('receive.index') }}?from='+$('[name="from"]').val()+'&to='+$('[name="to"]').val(),
            columns: [
                {data: 'check'},
                {data: 'date'},
                {data: 'description'},
                {data: 'value'},
                {data: 'category'},
                {data: 'method'},
                {
                    data: 'status', 
                  
                },
                {data: 'pay_date'},
                {data: 'actions'},
            ]
        })

        $('#check-all').change(function (e) { 
            e.preventDefault();
            $('[name="transactions[]"]').attr('checked', $(this).is(':checked'))
        });


       

        

        function receiveAll() {
            const data = getSelectedCheckboxes()

            $.ajax({
                type: "POST",
                url: "receive/get",
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data,
                },

                success: function (response) {
                    location.reload()
                }
            });

            
        }

        function deleteAll() {
            const data = getSelectedCheckboxes()

            $.ajax({
                type: "POST",
                url: "receive/delete",
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data,
                },

                success: function (response) {
                    location.reload()
                }
            });

            
        }

        function receive(id) {
            $.ajax({
                type: "get",
                url: '/receive/'+id+'/pay',
                success: function (response) {
                    $('#modal-container').html(response);
                    $('#modal-container .modal').modal('show');
                }
            });
        }

        function getSelectedCheckboxes() {
            return $('[name="transactions[]"]').filter(':checked').toArray().map((item) => item.value);    
        }


        
</script>

@endsection