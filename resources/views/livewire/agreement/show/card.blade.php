<div>
    <x-card>
{{--@dd($agreement)--}}
        <div class="flex items-center justify-between border-b-2 ">
            <h1 class="text-base text-gray-600 font-semibold py-2 pt-2 ">Confissão de Divida  : {{$agreement['franchising']['name']}}</h1>
        </div>
            <div class="flex flex-col justify-center w-full mb-2 ">
                <div>
                    <h6 class="text-center p-5">CONTRATO DE RENEGOCIAÇÃO DE DÍVIDA</h6>
                    <p class=" text-justify px-5">Pelo presente instrumento, de um lado a Empresa :  {{$agreement['franchising']['name'] }},  Sob Responsabilidade de : {{ $agreement['partner']['name'] }}, (estado civil), (Sócio), inscrito (a) no CPF sob o nº {{ $agreement['partner']['cpf']  }}, residente e domiciliado (a) à {{$agreement['franchising']['address']}}, doravante denominado (a) DEVEDOR (a), e de outro lado (nome), (nacionalidade), (estado civil), (profissão), inscrito (a) no CPF sob o nº (informar) e no RG nº (informar), residente e domiciliado (a) à (endereço), doravante denominado (a) CREDOR (a), ajustam este contrato de renegociação de dívida pelas condições que seguem.</p>
                    <p class=" text-justify p-5">Cláusula 1ª - O (a) DEVEDOR (a) declara que deve ao (à) CREDOR (a) a quantia atualizada e corrigida de R$ {{ formatMoney($agreement->agreements_amount, 2, ',','.') }} ({{$extenso->converter($agreement->agreements_amount)}}), em decorrência do(s) contrato de (informe a origem da dívida) firmado em (data do negócio que originou a dívida).</p>
                    <p class=" text-justify p-5">Cláusula 2ª - A dívida será paga pelo (a) DEVEDOR (A) por meio de uma entrada de  R$ {{ formatMoney($agreement['inflow']) }} e o restante em {{ $agreement['installments'] }} parcelas mensais, iguais e sucessivas de R$ {{ formatMoney($agreement['installment_value']) }} ({{$extenso->converter($agreement['installment_value'])}}), com vencimento todo dia 10 de cada mês, ou dia útil seguinte, vencendo a primeira em (data) e a última em (data).</p>
                    <p class=" text-justify p-5">Cláusula 3ª - As parcelas serão pagas mediante depósito na conta bancária do (a) CREDOR (a), junto ao Banco (informar) (número), agência (informar), conta corrente (informar).</p>
                    <p class=" text-justify p-5">Cláusula 4ª - O atraso no pagamento de qualquer das parcelas implicará em multa de 5% (cinco por cento) sobre o valor inadimplido, juros de mora de 1% (um por cento) ao mês e correção monetária pelo INPC.</p>
                    <p class=" text-justify p-5">Cláusula 5ª - Havendo atraso superior a 15 (quinze) dias no pagamento de qualquer das parcelas ocorrerá o vencimento antecipado das parcelas vincendas e poderá o (a) CREDOR (a) proceder a execução judicial da integralidade do débito, com os acréscimos da cláusula anterior, respondendo o (a) DEVEDOR (a) ainda pelos honorários advocatícios de 20% (vinte por cento) e custas processuais.</p>
                    <p class=" text-justify p-5">Cláusula 6ª - Eventual aceitação do (a) CREDOR (a) em receber parcelas pagas intempestivamente, a seu critério, não importará em novação, mas mera liberalidade, permanecendo inalteradas as cláusulas deste contrato.</p>
                </div>
            </div>
            <div class="flex justify-center w-full mb-2 ">
                <div class="w-2/3 text-center py-15">
                    <h6 class="text-center p-5">Relação de Lançamentos</h6>
                    <table class="tables">
                        <thead>
                        <tr>
                            <th class="w-30">Tipo</th>
                            <th>CNPJ</th>
                            <th>Vencimento</th>
                            <th>Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($releases as $release)
                            <tr>
                                <td>{{$release['name']}}</td>
                                <td>{{$release['cnpj']}}</td>
                                <td>{{ formatDate($release['due_date'])}}</td>
                                <td>{{ formatMoney($release['amount'])}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
    </x-card>
</div>

