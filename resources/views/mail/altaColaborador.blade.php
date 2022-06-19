@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ $logo }}" alt=""  class="logo">
@endcomponent
@endslot
# Estimado/a {{$colaborador->apellido_paterno . ' ' . $colaborador->nombre}}

Usted a sido dado de alta el día {{$dia . ' ' . $hora}}. Le dejamos adjuntado en este correo un código QR que debe presentar cuando se presente al hospital deseado.



Atentamente,
Equipo de SAIH.

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Sistema SAIH. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent