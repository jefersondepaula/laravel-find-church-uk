<h1 class="font-bold py-5 text-xl">Igrejas em Destaque</h1><br>
<div class="churchers flex flex-wrap gap-5">
    @foreach ($featuredChurches as $church)
        <div class="card w-72 bg-[#E6A57E] border border-cyan-100 p-3">
            <h2>{{ $church->name }}</h2>
            @if($church->photos->isNotEmpty())
                <img src="{{ $church->photos->first()->file_path }}" alt="Foto de {{ $church->name }}" style="width: 100%; height: auto;">
            @endif
            <p>{{ $church->description }}</p>
            <p>{{$church->address->town}}</p>
            <p>{{$church->address->county}}</p>
            <p>{{$church->website}}</p>
            <!-- Outros detalhes da igreja -->
        </div>
    @endforeach
</div>
