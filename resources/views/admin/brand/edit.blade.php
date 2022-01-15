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
                            Edit Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.brand', ['id' => $brand->id]) }}" method="POST" enctype="multipart/form-data">                                
                                @csrf                                
                                @method('PUT')
                                <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                                <div class="form-group">
                                  <label for="brand_name">Brand Name:</label>
                                  <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $brand->brand_name }}">           
                                  @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror       
                                <div class="form-group">
                                    <img src="{{ asset($brand->brand_image) }}" alt="" style="height:40px; width: 70px;">
                                </div>
                                <div class="form-group">
                                    <label for="brand_image">Image</label>                                    
                                    <input type="file" name="brand_image" id="brand_image" class="form-control">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror   
                                </div>
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
