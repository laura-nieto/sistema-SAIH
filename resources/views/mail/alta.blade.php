@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url'),'logo'=>$logo])
            SAIH
        @endcomponent
    @endslot
    # Estimado/a

    El {{$tipo}} {{$info_principal}} ha sido dado de alta en nuestro sistema el día {{$dia}} a las {{$hora}} por el usuario {{$usuario}} en {{$sede}}

    La información compartida es:

    @foreach ($informacion as $key => $info)
        * {{$key}}: {{$info}}
    @endforeach

    Atentamente,
    Equipo de SAIH.

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Sistema SAIH. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent