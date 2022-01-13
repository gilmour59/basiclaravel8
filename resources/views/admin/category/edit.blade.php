<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Edit Category
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.category', ['id' => $category->id]) }}" method="POST">                                
                                @csrf                                
                                @method('PUT')
                                <div class="form-group">
                                  <label for="category_name">Category Name:</label>
                                  <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}">           

                                  @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror       

                                </div>                            
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
