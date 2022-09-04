<div>

    <div class="row mb-4">
        <div class="col-md-12">
          <div class="float-right mt-5">
              <input wire:model="search" class="form-control" type="text" placeholder="Search Product...">
          </div>
        </div>
    </div>


    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                <button wire:click="edit({{ $product->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="delete({{ $product->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
