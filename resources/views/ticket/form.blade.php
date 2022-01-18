<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Ticket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-12">
                            <p class='formText'>Please fillup the form carefully</p>
                          <form method="POST" action="{{url('/')}}/ticket/save" enctype="multipart/form-data">
                              @csrf
                            <div class="mb-3">
                                <label for="catName" class="form-label">Title</label>
                                <input type="text" class="form-control" id="catName" name="title" >
                              </div>
                             
                              <div class="mb-3">
                                <label for="catName" class="form-label">Service</label>
                                <select class="form-control" id="catName" name="service">
                                  @foreach($service as $row=>$val)
                                  <option value={{$val->id}}>{{$val->name}}</option>
                                  @endforeach
                                 </select>
                              </div>

                              <div class="mb-3">
                                <label for="catName" class="form-label">Category</label>
                                <select class="form-control" id="catName" name="category">
                                @foreach($category as $row=>$val)
                                  <option value={{$val->id}}>{{$val->name}}</option>
                                  @endforeach
                                 </select>
                              </div>

                              <div class="mb-3">
                                <label for="catName" class="form-label">Priority</label>
                                <select class="form-control" id="catName" name="priority">
                                @foreach($priority as $row=>$val)
                                  <option value={{$val->id}}>{{$val->name}}</option>
                                  @endforeach
                                 </select>
                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Description</label>
                                <textarea class="form-control" id="catName" name="description"></textarea>

                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Screenshot</label>
                                <input type="file" class="form-control" id="catName" name="photo">
                   
                              </div>
                              <button value="Save" class="btn btn-primary">Save</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>