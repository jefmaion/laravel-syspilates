<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('receive.receve') }}" method="post">
            <input type="hidden" name="id" value="{{ $transaction->id }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-{{ theme() }}">
                    <h5 class="modal-title">Receber </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4><strong>{{ $transaction->description }} </strong></h4>
                    {{-- <x-transaction-status class="float-right" status="{{ $transaction->statusCode }}">{{ $transaction->statusDescription }}</x-transaction-status> --}}
                    <div><strong>Vencimento: </strong> {{ $transaction->date->format('d/m/Y') }}</div>
                    <div><strong>Valor: </strong> {{ $transaction->value }}</div>

                    <hr>

                    @if($transaction->feesValue > 0)

                    <input type="hidden" name="fees" value="{{ $transaction->feesValue }}">
                    <div class="row">


                        <div class="col">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6 class="mb-0 text-muted">Valor</h6>
                                    <h5>R$ {{ currency($transaction->value) }}</h5>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6 class="mb-0 text-muted">Juros</h6>
                                    <h5>R$ {{ currency($transaction->feesValue) ?? '0,00' }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6 class="mb-0 text-muted">Valor a receber</h6>
                                    <h5><strong>R$ {{ currency($transaction->valueWithFees) }}</strong></h5>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endif

                    <div class="row">

                        
                        <div class="col-6 form-group">
                            <label>Valor</label>
                            <x-form.input name="value" class="money" value="{{ old('value', currency($transaction->valueWithFees)) }}" />
                        </div>

                        <div class="col-6 form-group">
                            <label>Pagamento</label>
                            <x-form.select name="payment_method_id" :options="$payments"
                                value="{{ old('payment_method_id', $transaction->payment_method_id) }}" />
                        </div>



                        <div class="col-12 form-group">
                            <label>Observações</label>
                            <textarea class="form-control" name="comments" id=""
                                rows="2">{{ old('comments', $transaction->comments) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="mr-4 text-muted" data-dismiss="modal">Fechar</a>
                    <button type="submit" class="btn bg-{{ theme() }}">

                       <i class="fa fa-check-circle" aria-hidden="true"></i>
                        Receber
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.config.js') }}"></script>
