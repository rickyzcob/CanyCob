<div>
    <x-card cardClasses="h-80 border-l-4 border-green-500">
            <div class="items-start border-b-2 mb-2 justify-between">
                <h1 class="text-base text-gray-600 font-semibold ">Histórico de Cobranças</h1>
            </div>
        <div class="scrollbar" id="style-1">
            <table class="tables">
                <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Contato</th>
                    <th>Fone</th>
                    <div>
                        <th>Sucesso ?</th>
                    </div>

                </tr>
                </thead>
                    <tbody>
                        @foreach($response->historicReleases as $itemHistoric)
                            <tr>
                                <td>{{ $itemHistoric['type'] }} </td>
                                <td>{{ $itemHistoric['name'] }}</td>
                                <td>{{ $itemHistoric['phone'] }}</td>
                                <td>{{ $itemHistoric['success'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>

</x-card>
</div>
