<div style="overflow-x:auto;">
    <table id="myTable2" class="tables">
        <thead>
        <tr>
            <th class="cursor-pointer" onclick="sortTable(0)">Nome</th>
            <th>CNPJ</th>
            <th class="cursor-pointer" onclick="sortTable(0)">Valor Devido</th>
            <th class="cursor-pointer" onclick="sortTable(0)">Correção</th>
            <th class="cursor-pointer"  onclick="sortTable(0)">Status</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>

        <tbody>
        @foreach($response->charges as $itemCharge)
            <tr>
                <td>{{ $itemCharge['franchising']['name'] }}</td>
                <td>{{ $itemCharge['franchising']['cnpj'] }}</td>
                <td> {{ formatMoney($itemCharge['total_amount']) }}</td>
                <td> {{ formatMoney($itemCharge['total_amount_corrected']) }}</td>
                <td> <x-badge outline color="{{$itemCharge['status']['color']}}" label="{{$itemCharge['status']['name']}}" /></td>
                <td width="200px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        <x-button a href="{{route('charges.show', $itemCharge['reference'])}}" sm gray icon="eye" primary />
                        <x-button sm teal icon="cash" primary wire:click="openModal('charges.releases.table', {'charge_id': {{ $itemCharge['id'] }} } )"/>
                        <x-button sm orange icon="document-report" primary wire:click="openModal('charges.historic.table', {'charge_id': {{ $itemCharge['id']  }} } )"/>
                        <x-button sm cyan icon="folder" primary wire:click="openModal('charges.proposal.table', {'charge_id': {{ $itemCharge['id']  }} } )"/>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="flex justify-between text-black gap-2 py-5 text-gray-600 text-sm">
        <div class="flex items-center gap-2">
            Mostrando  <x-native-select
                :options="['10', '15', '20', '30', '60']"
                wire:model="pageSize"
            />
            de {{ $response->charges->total() }}
            itens
        </div>
        <div>
            {{ $response->charges    ->links() }}
        </div>
    </div>
</div>

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable2");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
