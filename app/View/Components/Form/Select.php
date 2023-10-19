<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{

    public $options;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options = [], $value = null)
    {
        $this->options = $options;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }

    public function isSelected($value, $key)
    {

        if(!is_array($value)) {
            $value = [$value];
        }

        foreach($value as $i => $v) {
            $value[$i] = (string) $v;
        }

        $key = (string) $key;


        return in_array($key, $value) ?  'selected' : '';
    }
}
