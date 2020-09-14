@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        @if(config('app.company_logo')!=null)
         <img src="{{config('app.url').'/storage/uploads/company_assets/'.config('app.company_logo')}}">
        @else
            {{ config('app.name') }}
        @endif
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} Youngminds. All rights reserved.<br>
Powered By: BeeDMS
        @endcomponent
    @endslot
@endcomponent
