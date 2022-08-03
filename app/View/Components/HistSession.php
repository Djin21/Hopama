<?php

namespace App\View\Components;

use App\Models\Consultation;
use Illuminate\View\Component;

class HistSession extends Component
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
        $consultations = Consultation::orderBy('created_at', 'desc')->get();
        return view('components.hist-session',[
            'consultations' => $consultations
        ]);
    }
}
