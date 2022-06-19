@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ $logo }}" alt=""  class="logo">
@endcomponent
@endslot
# Estimado/a

Usted a sido ingresado a la plataforma de SAIH. Muestre el siguiente código QR a la recepción.



Atentamente,
Equipo de SAIH.

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Sistema SAIH. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent