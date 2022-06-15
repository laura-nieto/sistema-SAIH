@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url'),'logo'=>$logo])
            SAIH
        @endcomponent
    @endslot
    # Estimado/a

    Usted a sido ingresado a la plataforma de SAIH. Muestre el siguiente código a la recepción:

    {{ url('/colaborador/').$colaborador_id}}

    Atentamente,
    Equipo de SAIH.

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Sistema SAIH. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent