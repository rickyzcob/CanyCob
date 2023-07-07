<div>
    <div class="md:col-span-3">
        <div class="relative px-3 rounded shadow-lg max-w-sm h-full bg-red-500">
            <div class="flex justify-between items-center">
                <div class="text-white">
                    <h6 class="uppercase font-semibold text-white">Total Cobranças</h6>
                    <h3 class="text-2xl font-semibold mt-0">{{ $response->total_historic }}</h3>
                    <div class="">
                        {{--                        <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-white text-gray-400 rounded text-xs"> +11% </span>--}}

                    </div>
                </div>
                <div class="text-slate-100  text-opacity-40 hover:from-pink-500">
                    <span class="material-icons text-8xl">pending_actions</span>
                </div>
            </div>
        </div>
    </div>
</div>
