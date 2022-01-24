<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(ucfirst($type)) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-12">
                            <p class='formText'>Please fillup the form carefully</p>
                          <form method="POST" action="{{url('/')}}/user/save" enctype="multipart/form-data">
                              @csrf
                            <div class="mb-3">
                                <label for="catName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="catName" name="name" @if(@isset($user))
                                    value="{{$user->name}}"                                    
                                @endif required>
                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Email</label>
                                <input type="email" class="form-control" id="catName" name="email" @if(@isset($user))
                                    value="{{$user->email}}"                                    
                                @endif required>
                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Password</label>
                                <input type="password" class="form-control" id="catName" name="password">
                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="catName" name="phone" @if(@isset($user))
                                    value="{{$user->userDetails->phoneNumber}}"                                    
                                @endif required>
                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Address</label>
                                <textarea type="text" class="form-control" id="catName" name="address" required>@if(@isset($user)){{$user->userDetails->address}}@endif</textarea>
                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Gender</label>
                                <select class="form-control" id="catName" name="gender">
                                    <option value="1" @if(@isset($user) && $user->userDetails->gender==1) selected @endif>Male</option>
                                    <option value="0" @if(@isset($user) && $user->userDetails->gender!=1) selected @endif>Female</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="catName" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="catName" name="photo">
                                <p class='info-text'>Suggested Size:300x300 pixels</p>
                                <img  src='{{url('/')}}/@if(@isset($user)){{$user->userDetails->photo}} @endif' width='80px' style="border: 1px solid;padding: 12px;margin: 5px;"  id="favicon">

                              </div>
                              <input type="hidden" name="type" value="{{$type}}">
                                  @if(@isset($user))
                                      <input type="hidden" name="id" value="{{$user->id}}">
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