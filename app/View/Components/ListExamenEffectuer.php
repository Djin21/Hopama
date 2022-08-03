<?php

namespace App\View\Components;

use App\Models\Paiement;
use Illuminate\View\Component;

class ListExamenEffectuer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $paiements = Paiement::orderBy('created_at', 'desc')->get();
        return view('components.list-examen-effectuer', [
            'paiements' => $paiements
        ]);
    }
}
