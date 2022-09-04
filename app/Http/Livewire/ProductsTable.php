<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsTable extends Component
{

    public $products, $name, $description, $price;
    public $search = '';
    public $updateMode = false;




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        // $this->products = Product::all();
        // return view('livewire.products-table');
        $this->products = Product::search($this->search);

        //$p = $this->search($this->search);
        return view('livewire.products-table');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->description = '';
        $this->price = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        Product::create($validatedDate);

        session()->flash('message', 'product Created Successfully.');

        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->updateMode = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product = Product::find($this->product_id);
        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'product Updated Successfully.');
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'product Deleted Successfully.');
    }
}
