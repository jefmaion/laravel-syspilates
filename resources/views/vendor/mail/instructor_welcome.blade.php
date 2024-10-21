
@component('mail::message')

<p>Olá, <strong>{{ $instructorName }}</strong>!</p>
<p>Estamos felizes em recebê-lo em nossa plataforma. Agradecemos pelo seu cadastro e desejamos que você tenha uma ótima experiência conosco.</p>

<h3>Suas Credenciais de Primeiro Acesso:</h3>
<p><strong>Usuário:</strong> {{ $user->email }}</p>
<p><strong>Senha:</strong> {{ $password }}</p> <!-- Certifique-se de enviar a senha de forma segura -->

@component('mail::button', ['url' => route('login')])
Acessar o {{ config('app.name') }}
@endcomponent

<p>Se tiver alguma dúvida ou precisar de ajuda, não hesite em nos contatar.</p>
<p>Obrigado por escolher nossa plataforma!</p>


Obrigado,<br>
{{ config('app.name') }}
@endcomponent
