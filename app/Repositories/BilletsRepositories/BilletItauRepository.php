<?php

namespace App\Repositories\BilletsRepositories;

class BilletItauRepository
{
    public function generate()
    {
        $beneficiario = new \Eduardokum\LaravelBoleto\Pessoa([
            'documento' => '00.000.000/0000-00',
            'nome'      => 'Company co.',
            'cep'       => '00000-000',
            'endereco'  => 'Street name, 123',
            'bairro' => 'district',
            'uf'        => 'UF',
            'cidade'    => 'City',
        ]);

        $pagador = new \Eduardokum\LaravelBoleto\Pessoa([
            'documento' => '00.000.000/0000-00',
            'nome'      => 'Company co.',
            'cep'       => '00000-000',
            'endereco'  => 'Street name, 123',
            'bairro' => 'district',
            'uf'        => 'UF',
            'cidade'    => 'City',
        ]);

        $itau = new Eduardokum\LaravelBoleto\Boleto\Banco\Itau([
            'logo' => '/path/to/logo.png',
            'dataVencimento' => '1997-10-07',
            'valor' => 100,
            'numero' => 1,
            'numeroDocumento' => 1,
            'pagador' => $pagador,
            'beneficiario' => $beneficiario,
            'carteira' => 109,
            'agencia' => 1111,
            'conta' => 22222,
            'multa' => 1, // 1% do valor do boleto após o vencimento
            'juros' => 1, // 1% ao mês do valor do boleto
            'jurosApos' => 0, // quant. de dias para começar a cobrança de juros,
            'descricaoDemonstrativo' => ['demonstrativo 1', 'demonstrativo 2', 'demonstrativo 3'],
            'instrucoes' => ['instrucao 1', 'instrucao 2', 'instrucao 3'],
]);
    }



}
