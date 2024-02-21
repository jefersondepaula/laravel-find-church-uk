
@if(request()->has('religion'))
    <div class="churchers flex flex-wrap gap-6 flex-col">
        <h1 class="text-gray-700 font-bold my-4">Igrejas Filtradas {{$churches->count()}}</h1>
        <div class="flex flex-wrap gap-2 justify-center overflow-y-scroll max-h-[530px]">
            @foreach ($churches as $church)
                <div class="card-church-filtered w-52 bg-[#7DAEDB] border border-cyan-100 p-3"
                data-longitude="{{$church->address->longitude}}" data-latitude="{{$church->address->latitude}}">
                    <p>{{$church->name}}</p>
                    <p>{{$church->contact_info}}</p>
                    <p>{{$church->address->town}}</p>
                    <p>{{$church->address->county}}</p>
                </div>
             @endforeach
        </div>
    </div>
@endif

