<div>
    <x-card cardClasses="md:h-52 border-l-4 border-orange-400">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2 ">Dados Cadastrais</h1>
            @if($charge['agreement'] == 0)
                @can('edit_franchising_charges')
            <x-button.circle wire:click="openModal('tenant.franchising.form', {'id': {{$franchising['id']}} })" sm warning icon="pencil-alt" />
                @endcan
            @endif
        </div>
        <div class="flex items-start justify-between mb-2">
            <div class="justify-between items-center w-full">
                <p> <span class="font-bold"> Razão Social : </span>{{$franchising['razao_social']}}</p>
                <p> <span class="font-bold"> Endereço : </span> {{$franchising['address']}} - {{$franchising['number']}} - {{$franchising['complement']}} - {{$franchising['cep']}} </p>
                <p> <span class="font-bold"> Região : </span> {{$franchising['regiao']}} </p>
                <p> <span class="font-bold"> Telefones : </span> {{$franchising['phone01']}} - {{$franchising['phone02']}}</p>
                <p> <span class="font-bold"> CNPJ : </span> {{$franchising['cnpj']}} <span class="font-bold"> Inscrição Estadual : </span> {{$franchising['insc']}} </p>
                <p> <span class="font-bold"> {{$franchising['city']}} - {{$franchising['state']}}  </span>  </p>
            </div>
        </div>
    </x-card>
</div>
