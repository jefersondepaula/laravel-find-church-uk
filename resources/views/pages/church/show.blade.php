<div class="">
    <h1 class="text-gray-700">Igrejas Filtradas</h1>
</div>

@if(request()->has('religion'))
    <div class="churchers flex flex-wrap gap-6">
        @foreach ($churches as $church)
            <div class="card-church-filtered w-72 bg-[#7DAEDB] border border-cyan-100 p-3"
            data-longitude="{{$church->address->longitude}}" data-latitude="{{$church->address->latitude}}">
                <p>{{$church->name}}</p>
                <p>{{$church->contact_info}}</p>
                <p>{{$church->address->town}}</p>
                <p>{{$church->address->county}}</p>
            </div>
        @endforeach
    </div>
@endif
