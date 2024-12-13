<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SuccessMessage extends Component
{
    public $message;

    /**
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.success-message');
    }
}
