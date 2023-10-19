<div class="row">
    <div class="col-12 col-xl-4 ofsfset-md-3">

        <div class="card card-outline card-secondary">

            <div class="card-body">

                @csrf

                <div class="row">

                    <div class="col-4 form-group">
                        <label>Data de Vencimento</label>
                        <x-form.input type="date" name="date" value="{{ old('date', (!empty($transaction->date) ? $transaction->date->format('Y-m-d') :  date('Y-m-d'))) }}" />
                    </div>

                    <div class="col-4 form-group">
                        <label>Valor</label>
                        <x-form.input name="value" class="money" value="{{ old('value', currency($transaction->value)) }}" />
                    </div>
                
                    <div class="col-4 form-group">
                        <label>Pagamento</label>
                        <x-form.select name="payment_method_id" :options="$payments"
                            value="{{ old('payment_method_id', $transaction->payment_method_id) }}" />
                    </div>
                
                    <div class="col-12 form-group">
                        <label>Descrição</label>
                        <x-form.input name="description" value="{{ old('description',  $transaction->description) }}" />
                    </div>
                
                    <div class="col-12 form-group">
                        <label>Categoria</label>
                        <x-form.select name="category_id" :options="$categories"
                            value="{{ old('category_id', $transaction->category_id) }}" />
                    </div>
                
                    <div class="col-12 form-group">
                        <label>Aluno/Pagador</label>
                        <x-form.select name="student_id" :options="$students"
                            value="{{ old('student_id', $transaction->student_id) }}" />
                    </div>
                
                    <div class="col-12 form-group">
                        <label>Observações</label>
                        <textarea class="form-control" name="comments" id="" rows="3">{{ old('comments', $transaction->comments) }}</textarea>
                    </div>

                    <div class="col-6 form-group">

                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" class="form-check-input" name="status" id="" value="1" {{ ($transaction->status == 1) ? 'checked' : '' }}>
                            Marcar como Pago
                          </label>
                        </div>

                        <div class="mt-3">

                            <label>Data de Pagamento</label>
                            <x-form.input type="date" name="pay_date" value="{{ old('date', (!empty($transaction->pay_date) ? $transaction->pay_date->format('Y-m-d') :  null)) }}" />

                        </div>
                    </div>

                
                </div>

                @if(!$transaction->id)
                <h5 class="border-bottom mb-3"><strong>Repetir Lançamento</strong></h5>
                <div class="row">
                    <div class="col-4 form-group">
                        <label>Vezes</label>
                        <x-form.input type="number" name="repeat" value="{{ old('repeat') }}" />
                    </div>

                    <div class="col-8 form-group">
                        <label>Período</label>
                        <x-form.select name="period" :options="[
                            '1 days' => 'Diariamente',
                            '7 days' => 'Semanalmente',
                            '1 months' => 'Mensalmente',
                        ]" value="{{ old('period') }}" />
                    </div>
                </div>
                @endif

            </div>

            <div class="card-footer">
                <a name="" id="" class="btn btn-outline-secondary" href="{{ (isset($transaction->id)) ? route('receive.show', $transaction) : route('receive.index') }}"
                    role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>

                <button type="submit" class="btn bg-olive">
                    <x-icon icon="save">Salvar</x-icon>
                </button>
            </div>
        </div>
    </div>

</div>

@section('scripts')

<script>
    $('[name="status"]').change();
    $('[name="status"]').change(function (e) { 
        e.preventDefault();
        $('[name="pay_date"]').attr('disabled', !$(this).is(':checked'))
    });
</script>
@endsection