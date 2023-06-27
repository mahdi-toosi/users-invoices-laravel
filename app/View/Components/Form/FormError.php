<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class FormError extends Component
{
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('components.form.form-error');
    }
}
