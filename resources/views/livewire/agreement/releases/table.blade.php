<div>
    <x-card cardClasses="border-l-4 border-red-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2">Relação de Lançamentos do Acordo</h1>
        </div>
        <table class="tables">
            <thead>
            <tr>
                <th width="300px">Nome</th>
                <th>Vencimento</th>
                <th>Valor</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            @foreach($response->releases as $itemRelease)
                <tr>
                    <td>{{ $itemRelease['name'] ? $itemRelease['name'] : 'Sem Informação' }}</td>
                    <td>{{ formatDate($itemRelease['due_date'] ) }}</td>
                    <td>{{ formatMoney($itemRelease['amount'] )}}</td>
                    <td><x-badge color="{{$itemRelease['status']['color']}}" label="{{$itemRelease['status']['name']}}" /></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</div>
