<?php

namespace App\Http\Livewire\Teste;

use Livewire\Component;

class Teste extends Component
{
    protected $listeners = [
        'capet' => '$refresh',
        'capeta' => 'delete',
        'filterTableUsers'
    ];
    public function delete()
    {
        dd('caiu');
    }

    public function render()
    {
        return view('livewire.teste.teste');
    }
}
