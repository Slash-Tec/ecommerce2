<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Livewire\Component;

class ColorProduct extends Component
{
    public $product, $colors;
    public $color_id, $quantity;
    public $open = true;

    protected $rules = [
        'color_id' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function mount()
    {
        $this->colors = Color::all();
    }

    public function save(){
        $this->validate();

        $this->product->colors()->attach([
            $this->color_id => [
                'quantity' => $this->quantity
            ]
        ]);

        /*$pivot = Pivot::where('color_id', $this->color_id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($pivot) {
            $pivot->quantity = $pivot->quantity + $this->quantity;
            $pivot->save();
        } else {
            $this->product->colors()->attach([
                $this->color_id => [
                    'quantity' => $this->quantity
                ]
            ]);
        }*/

        $this->reset(['color_id', 'quantity']);

        $this->emit('saved');

        $this->product = $this->product->fresh();

    }

    public function render()
    {
        $productColors = $this->product->colors;

        return view('livewire.admin.color-product', compact('productColors'));
    }
}
