@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url'),'logo'=>$logo])
            SAIH
        @endcomponent
    @endslot
    # Estimado/a

    Su {{$tipo}} {{$info}} ha sido dado de baja en nuestro sistema el día {{$dia}} a las {{$hora}} por el usuario {{$usuario}} en {{$sede}}


    Atentamente,
    Equipo de SAIH.

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Sistema SAIH. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent