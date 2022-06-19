@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ $logo }}" alt=""  class="logo">
@endcomponent
@endslot
# Estimado/a {{$colaborador->apellido_paterno . ' ' . $colaborador->nombre}}

Usted a sido dado de alta el día {{$dia . ' ' . $hora}}. A continuación le dejamos un código QR que debe presentar cuando se presente al hospital deseado.

<img src="{{$codigo_qr}}" alt="" width="200px" height="200px">

Atentamente,
Equipo de SAIH.

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Sistema SAIH. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent