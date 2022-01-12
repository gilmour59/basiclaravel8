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
                            All Category
                        </div>
                    
                        <table class="table">
                            <thead>
                            <tr>                                                    
                                <th scope="col">Category Name</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Created At</th>                                
                            </tr>
                            </thead>
                            <tbody>
                                @isset($categories)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $category->category_name }}</th>
                                            <td>{{ $category->user_id }}</td>
                                            @isset($category->created_at)
                                                <td>{{ $category->created_at->diffForHumans() }}</td>    
                                            @else
                                                <td><span class="text-danger">No Date Found!</span></td>
                                            @endisset                                            
                                        </tr>                  
                                    @endforeach                                    
                                @endisset                                      
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Category
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label for="category_name">Category Name:</label>
                                  <input type="text" class="form-control" id="category_name" name="category_name">           

                                  @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror       

                                </div>                            
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
