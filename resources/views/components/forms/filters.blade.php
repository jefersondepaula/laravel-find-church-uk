<div class="p-5 bg-slate-100 opacity-90 rounded-md shadow-2xl">
    <h2 class="font-bold">Filtrar Igrejas</h2><br>
    <form action="{{ route('home') }}" method="GET" class="flex flex-wrap gap-4">
        <!-- Filtro por Religião -->
        <select name="religion">
            <option value="">Selecione a Religião</option>
            @foreach ($religions as $religion)
                <option value="{{ $religion->id }}">{{ $religion->name }}</option>
            @endforeach
        </select>

        <!-- Filtro por Idioma do Serviço -->
        <select name="language">
            <option value="">Selecione o Idioma</option>
            @foreach ($languages as $language)
                <option value="{{ $language->id }}">{{ $language->name }}</option>
            @endforeach
        </select>

        <!-- Filtro por Facilidade -->
        <select name="facility">
            <option value="">Selecione a Facilidade</option>
            @foreach ($facilities as $facility)
                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
            @endforeach
        </select>

        <!-- Filtro por Dia da Semana -->
        <select name="dayOfWeek">
            <option value="">Selecione o Dia da Semana</option>
            <option value="1">Domingo</option>
            <option value="2">Segunda-feira</option>
            <option value="3">Terça-feira</option>
            <option value="4">Quarta-feira</option>
            <option value="5">Quinta-feira</option>
            <option value="6">Sexta-feira</option>
            <option value="7">Sábado</option>
        </select>

        {{-- Pelo tamanho da congregacao --}}
        <select name="congregationSize">
            <option value="">Selecione o Tamanho da Congregação</option>
            <option value="1">Menos de 50</option>
            <option value="2">50 a 100</option>
            <option value="3">100 a 150</option>
            <option value="4">150 a 200</option>
            <option value="5">200 a 250</option>
            <option value="6">250 a 300</option>
            <option value="7">300 a 350</option>
            <option value="8">350 a 400</option>
            <option value="9">400 a 450</option>
            <option value="10">450 a 500</option>
        </select>

        <!-- Filtro por Cidade -->
        <select name="town">
            <option value="">Selecione a cidade</option>
            @foreach ($towns as $town)
                <option value="{{ $town }}">{{ $town }}</option>
            @endforeach
        </select>

        <!-- Filtro por Condado -->
        <select name="county">
            <option value="">Selecione o Condado</option>
            @foreach ($counties as $county)
                <option value="{{ $county }}">{{ $county }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-slate-700 rounded-md p-3 px-6 text-white font-bold">Filtrar</button>
    </form>

</div>

