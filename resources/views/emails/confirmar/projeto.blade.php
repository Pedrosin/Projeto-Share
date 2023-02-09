@component('mail::message')
# Nova solicitação de projeto

O projeto {{$nm_projeto}} acabou de realizar o cadastro na Share. 

Analise o projeto o quanto antes para que novas pessoas sejam ajudadas!

@component('mail::button', ['url' => $url])
Confirmar projeto
@endcomponent

Obrigado,<br>
Projeto Share
@endcomponent
