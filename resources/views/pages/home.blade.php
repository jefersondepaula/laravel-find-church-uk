@extends('components.layouts.app')

@section('content')

@include('pages.church.slider')

<div class="container mx-auto">

    <div class="absolute z-10 top-1/3">
        @include('components.forms.filters')
        {{-- <x-forms.filters/> --}}
    </div>

    @include('pages.church.featured')

    @include('pages.church.show')

    @include('components.maps.interactiveMap')

</div>





@endsection
