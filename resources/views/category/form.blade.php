<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-12">
                          <form method="POST" action="{{url('/')}}/category/save">
                              @csrf
                            <div class="mb-3">
                                <label for="catName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="catName" placeholder="Bill" name="name" @if(@isset($category))
                                    value="{{$category->name}}"                                    
                                @endif>
                              </div>
                                  @if(@isset($category))
                                      <input type="hidden" name="id" value="{{$category->id}}">
                                  @endif
                              <button value="Save" class="btn btn-primary">Save</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>