@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <i class="fa fa-users" aria-hidden="true"></i> <strong>Contas a Receber</strong> - Detalhes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('receive.index') }}">Modalidades</a></li>
                <li class="breadcrumb-item active">Detalhes</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')



<div class="row">
    <div class="col-6">
        <div class="card card-outline card-secondary">

            <div class="card-body">
                <div>
                    <span class="badge badge-pill badge-light border">{{ $transaction->method->name ?? null }}</span>
                    <span class="badge badge-pill badge-light border">{{ $transaction->category->name ?? '' }}</span>
                </div>
                <h4 class="m-0"><strong>{{ $transaction->description }}</strong> </h4>

                

                {{-- <p>{{ $transaction->date->format('d/m/Y') }} • {{ currency($transaction->value) }} • • {{
                    $transaction->method->name }}</p> --}}
                <p class="text-muted">{{ $transaction->comments }}</p>
                <hr>

                <dl class="row">

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        <x-transaction-status status="{{ $transaction->statusCode }}">{{ $transaction->statusDescription
                            }}</x-transaction-status>
                    </dd>

                    <dt class="col-sm-4">Data de vencimento</dt>
                    <dd class="col-sm-8">{{ $transaction->date->format('d/m/Y') }}</dd>

                    <dt class="col-sm-4">Data de pagamento</dt>
                    <dd class="col-sm-8">{{ ($transaction->pay_date) ? $transaction->pay_date->format('d/m/Y') :  '-' }}</dd>

                    <dt class="col-sm-4">Valor Devido</dt>
                    <dd class="col-sm-8">R$ {{ currency($transaction->original_value) }}</dd>

                    <dt class="col-sm-4">Juros</dt>
                    <dd class="col-sm-8">R$ {{ currency($transaction->fees) }}</dd>

                    <dt class="col-sm-4">Valor a Pagar</dt>
                    <dd class="col-sm-8">R$ {{ currency($transaction->value) }}</dd>

               
                </dl>


            </div>

            <div class="card-footer">
                <a name="" id="" class="btn btn-outline-secondary" href="{{ route('receive.index') }}" role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>

               
                @if(!$transaction->status)
                <a name="" id="" class="btn bg-olive" href="#" onclick="receive({{ $transaction->id }})" role="button">
                    <x-icon icon="edit">Receber</x-icon>
                </a>
                @endif
                <button class="btn bg-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    Mais Ações
                </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="{{ route('receive.edit', $transaction) }}">
                        <x-icon icon="edit">Editar</x-icon>
                    </a>
                    <div class="dropdown-divider"></div>

                    <a name="" id="" class="bbtn bbtn-outline-danger dropdown-item"
                        route="{{ route('receive.destroy', $transaction) }}" href="#" data-toggle="modal"
                        data-target="#modal-delete-{{ $transaction->id }}" role="button">
                        <x-icon icon="delete">Excluir</x-icon>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

@include('receive.receive-include')
@endsection