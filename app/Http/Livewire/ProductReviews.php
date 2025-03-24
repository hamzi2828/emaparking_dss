<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Space\Models\Space;

class ProductReviews extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $space;

    public function mount($space_id) {
        $this->space = Space::find($space_id);
    }
    public function render()
    {
        return view('livewire.product-reviews',['review_list' => $this->space->getReviewList()]);
    }
}
