<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class selectorComponent extends Component
{
    public $items;
    public $modalName;
    public $placeholder;

    /**
     * Create a new component instance.
     * @param array $items
     * @param string $modalName
     * @param string $placeholder
     */
    public function __construct($items, $modalName, $placeholder)
    {
        $this->items = $items;
        $this->modalName = $modalName;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.selector-component');
    }
}
