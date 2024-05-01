<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SelectOption extends Component
{
    #[Modelable]
    public $value = null;
    public $name;
    public $label;
    public $text;
    public $parent;
    #[Reactive]
    public $options;

    public function mount($name, $label, $text, $parent, $options): void
    {
        $this->name = $name;
        $this->label = $label;
        $this->text = $text;
        $this->parent = $parent;
        $this->options = $options;
    }

    public function render()
    {
        return view('livewire.select-option');
    }
}
