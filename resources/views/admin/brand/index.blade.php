<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">                                
                                    Success                                
                                </h4>
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                        <div class="card-header">
                            All Brands
                        </div>
                    
                        <table class="table">
                            <thead>
                            <tr>                                                    
                                <th scope="col">Brand Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Created At</th> 
                                <th scope="col">Action</th>                                
                            </tr>
                            </thead>
                            <tbody>
                                @isset($brands)
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <th scope="row">{{ $brand->brand_name }}</th>
                                            <td><img src="{{ asset($brand->brand_image) }}" alt="" style="height:40px; width: 70px;"></td>
                                            @isset($brand->created_at)
                                                <td>{{ $brand->created_at->diffForHumans() }}</td>    
                                            @else
                                                <td><span class="text-danger">No Date Found!</span></td>
                                            @endisset 
                                            <td>
                                                <a href="{{ route('edit.brand', ['id' => $brand->id]) }}" class="btn btn-info">Edit</a>    
                                                <a href="{{ route('delete.brand', ['id' => $brand->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                            </td>                                           
                                        </tr>                  
                                    @endforeach                                    
                                @endisset                                      
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_name">Brand Name:</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name">           
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror       
                                    <div class="form-group">
                                        <label for="brand_image">Image</label>
                                        <input type="file" name="brand_image" id="brand_image" class="form-control">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror   
                                    </div>
                                </div>                            
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">                        
                        <div class="card-header">
                            All Trashed Brands
                        </div>
                    
                        <table class="table">
                            <thead>
                            <tr>                                                    
                                <th scope="col">Brand Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Created At</th> 
                                <th scope="col">Action</th>                                
                            </tr>
                            </thead>
                            <tbody>
                                @isset($trash_brands)
                                    @foreach ($trash_brands as $trash_brand)
                                        <tr>
                                            <th scope="row">{{ $trash_brand->brand_name }}</th>
                                            <td>{{ $trash_brand->brand_image }}</td>
                                            @isset($trash_brand->created_at)
                                                <td>{{ $trash_brand->created_at->diffForHumans() }}</td>    
                                            @else
                                                <td><span class="text-danger">No Date Found!</span></td>
                                            @endisset 
                                            <td>
                                                <a href="{{ route('restore.brand', ['id' => $trash_brand->id]) }}" class="btn btn-info">Restore</a>    
                                                <a href="{{ route('delete.brand', ['id' => $trash_brand->id]) }}" class="btn btn-danger">Permanent Delete</a>
                                            </td>                                           
                                        </tr>                  
                                    @endforeach                                    
                                @endisset                                      
                            </tbody>
                        </table>
                        {{ $trash_brands->links() }}
                    </div>
                </div>                
            </div>
        </div>
    </div>
</x-app-layout>
