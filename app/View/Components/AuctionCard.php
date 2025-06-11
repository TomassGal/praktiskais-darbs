<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuctionCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $auction;
    public function __construct($auction)
    {
        $this->auction = $auction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auction-card');
    }
}
