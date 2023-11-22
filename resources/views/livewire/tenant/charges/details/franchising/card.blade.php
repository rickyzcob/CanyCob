<div>
    <x-card cardClasses="md:h-52 border-l-4 border-orange-400">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <div class="flex items-center text-base text-orange-600 font-bold gap-x-2">
                <span class="material-icons text-base ">arrow_circle_down</span>
                <h1 class="text-base  py-1">Dados cadastrais</h1>
            </div>
            @if($charge['agreement'] == 0)
                @can('edit_franchising_charges')
            <x-button.circle wire:click="openModal('tenant.franchising.form', {'id': {{$franchising['id']}} })" xs warning icon="pencil-alt" />
                @endcan
            @endif
        </div>
        <div class="flex items-start justify-between mb-2">
            <div class="justify-between items-center w-full">
                <p> <span class="font-bold"> Razão Social : </span>{{$franchising['corporate_name']}}</p>
                <p> <span class="font-bold"> Endereço : </span> {{$franchising['address']}} - {{$franchising['number']}} - {{$franchising['complement']}} - {{$franchising['zip_code']}} </p>
                <p> <span class="font-bold"> Região : </span> {{$franchising['region']}} </p>
                <p> <span class="font-bold"> Telefones : </span> {{$franchising['phone01']}} - {{$franchising['phone02']}}</p>
                <p> <span class="font-bold"> CNPJ : </span> {{$franchising['employer_number']}} <span class="font-bold"> Inscrição Estadual : </span> {{$franchising['state_registration']}} </p>
                <p> <span class="font-bold"> {{$franchising['city']}} - {{$franchising['state']}}  </span>  </p>
            </div>
        </div>
    </x-card>
</div>
