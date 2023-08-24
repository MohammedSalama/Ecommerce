<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeaderSearchComponent extends Component
{
    /**
     * @var
     */
    public $q;

    /**
     * @return void
     */
    public function mount()
    {
        $this->fill(request()->only('q'));
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('livewire.header-search-component');
    }
}
