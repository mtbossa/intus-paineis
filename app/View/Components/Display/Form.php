<?php

namespace App\View\Components\Display;

use Illuminate\View\Component;

use App\Models\Display;

class Form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Display $display
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.display.form');
    }
}
