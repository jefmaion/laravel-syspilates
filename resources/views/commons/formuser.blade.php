<h6 class="border-bottom"><b>1. Dados Cadastrais</b></h6>
<div class="row">

    <div class="col-12 col-sm-6 col-md-6 form-group">
        <label>Nome*</label>
        <x-form.input name="user[name]" class="font-weight-bold" value="{{ old('user.name', $user->name ?? request()->get('name')) }}" />
    </div>

    <div class="col-12 col-sm-3 col-md-3 col-lg-3  form-group">
        <label>Data de Nascimento*</label>
        <x-form.input type="date" name="user[birth_date]"
            value="{{ old('user.birth_date', $user->birth_date ?? '') }}" />
    </div>

    <div class="col-12 col-sm-3 col-md-3 col-lg-3  form-group">
        <label>Sexo*</label>
        <x-form.select name="user[gender]" class="select2 w-100" value="{{ old('user.gender', $user->gender ?? '') }}"
            :options="['M' => 'Masculino', 'F' => 'Feminino']" />
    </div>

    

</div>

<div class="row">

    <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-4 form-group">
        <label>CPF*</label>
        <x-form.input name="user[cpf]" class="cpf" value="{{ old('user.cpf', $user->cpf ?? '') }}" placeholder="   .   .   -" />
    </div>

    <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-4 form-group">
        <label>Telefone (WhatsApp)</label>*
        <x-form.input type="text" class="sp_celphones" name="user[phone_wpp]"
            value="{{ old('user.phone_wpp', $user->phone_wpp ?? request()->get('phone_wpp')) }}" placeholder=" ( )" />
    </div>

    <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-4 form-group">
        <label>Telefone Recado</label>
        <x-form.input type="text" class="sp_celphones" name="user[phone2]"
            value="{{ old('user.phone2', $user->phone2 ?? '') }}"  placeholder=" ( )" />
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-12 form-group">
        <label>E-mail</label>
        <x-form.input type="email" name="user[email]" value="{{ old('user.email', $user->email ?? '') }}" />
    </div>

</div>

<h6 class="mt-2 border-bottom"><strong>2. Endereço</strong></h6>
<div class="row">

    <div class="col-12 col-sm-3 col-md-3 col-lg-3  form-group">
        <label>CEP</label>
        <x-form.input type="text" class="cep" id="cep" name="user[zipcode]"
            value="{{ old('user.zipcode', $user->zipcode ?? '') }}" />
    </div>

    <div class="col-12 col-sm-9 col-md-9 col-lg-7 form-group">
        <label>Endereço</label>
        <x-form.input type="text" class="viacep" data-viacep-name="logradouro" name="user[address]"
            value="{{ old('user.address', $user->address ?? '') }}" />
    </div>

    <div class="col-12 col-sm-2 col-md-2 col-lg-2 form-group">
        <label>Nº</label>
        <x-form.input type="text" name="user[number]" value="" />
    </div>

    <div class="col-12 col-sm-10 col-md-10 col-lg-3 form-group">
        <label>Complemento</label>
        <x-form.input type="text" class="viacep" data-viacep-name="complemento" name="user[complement]"
            value="{{ old('user.complement', $user->complement ?? '') }}" />
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 form-group">
        <label>Bairro</label>
        <x-form.input type="text" class="viacep" data-viacep-name="bairro" name="user[district]"
            value="{{ old('user.district', $user->district ?? '') }}" />
    </div>

    <div class="col-12 col-sm-4 col-md-4 col-lg-3 form-group">
        <label>Cidade</label>
        <x-form.input type="text" class="viacep" data-viacep-name="localidade" name="user[city]"
            value="{{ old('user.city', $user->city ?? '') }}" />
    </div>

    <div class="col-12 col-sm-2 col-md-2 col-lg-2 form-group">
        <label>Estado</label>
        <x-form.input type="text" class="viacep" data-viacep-name="uf" name="user[state]"
            value="{{ old('user.state', $user->state ?? '') }}" />
    </div>
</div>





@section('scripts')

<script>
    function setFieldsData(data) {
        $('.viacep').each(function (index, element) {
            $(element).val(data)
        });
    }

    function setData(data) {
        $('.viacep').each(function (index, element) {
            key = $(element).data('viacep-name')
            $(element).val(data[key])
        });
    }

    $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep == "") {
            return false
        } 

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(!validacep.test(cep)) {
            $('.viacep').val('')
            return null;
        }

        $.ajax({
            type: "get",
            url: "https://viacep.com.br/ws/"+ cep +"/json/?callback=?",
            dataType: "json",
            beforeSend: function (e) {
                $('.viacep').val('...')
            },
            success: function (response) {
                $('.viacep').val('')
                if (!("erro" in response)) {
                    setData(response)
                    $('[name="number"]').focus()
                    return 
                }
                return
            }
        });
    });
</script>
@parent
@endsection