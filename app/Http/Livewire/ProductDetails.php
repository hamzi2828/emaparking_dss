<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Space\Models\Space;

class ProductDetails extends Component
{
    public $row;
    public $translation;
    protected $review_list;
    public $bookingModal = true;

    protected $listeners =  ['getProduct' => 'getProduct'];

    public function getProduct($id) {

        $this->row = Space::find($id);
        $this->translation = $this->row->translate();
        $this->review_list = $this->row->getReviewList();
    }
    public function render()
    {
        return view('livewire.product-details', ['review_list' => $this->review_list]);
    }
}
