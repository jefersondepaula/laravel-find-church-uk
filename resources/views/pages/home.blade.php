@extends('components.layouts.app')

@section('content')

@if($request->hasAny(['religion', 'language', 'dayOfWeek', 'facility', 'town', 'county', 'congregationSize']))
    {{-- Conteúdo a ser mostrado se houver resultados dos filtros --}}

    <div class="flex">
        <div class="w-1/3">
            @include('components.forms.filters')
            @include('pages.church.show')
        </div>

        <div class="w-screen">
            @include('components.maps.interactiveMap')
        </div>

    </div>
@else
    {{-- Mostrar o slider e igrejas em destaque se não houver resultados de filtro ou nenhum filtro for submetido --}}
    @include('pages.church.slider')

    <div class="container mx-auto">
        <div class="absolute z-10 top-40 w-96">
            @include('components.forms.filters')
            {{-- <x-forms.filters/> --}}
        </div>

        @include('pages.church.featured')
    </div>
@endif

@endsection
