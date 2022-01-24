<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organization Setting') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-6">
                            <p class='formText'>Please fillup the form carefully</p>
                        <form method="POST" action="{{url('/')}}/setting/organization/save" enctype="multipart/form-data">
                              @csrf
                            <div class="mb-3">
                                <label for="catName" class="form-label">Organization Name</label>
                                <input type="text" class="form-control" id="catName" name="name" @if(@isset($organization))
                                    value="{{$organization->companyName}}"                                    
                                @endif required>
                              </div>

                              <div class="mb-3">
                                <label for="catName" class="form-label">Organization Email</label>
                                <input type="email" class="form-control" id="catName" name="email" @if(@isset($organization))
                                    value="{{$organization->email}}"                                    
                                @endif required>
                              </div>

                              <div class="mb-3">
                                <label for="catName" class="form-label">Footer Text</label>
                                <input type="text" class="form-control" id="catName" name="footerText" @if(@isset($organization))
                                    value="{{$organization->footerText}}"                                    
                                @endif required>
                              </div>

                              <div class="mb-3">
                                <label for="largeLogo" class="form-label">Large Logo</label>
                                <input type="file" class="form-control" id="largeLogo" name="largeLogo">
                                <p class='info-text'>Suggested Size: 423x76 pixels</p>
                                <img  src='{{url('/')}}/@if(@isset($organization)){{$organization->largeLogo}} @endif' width='80px' style="border: 1px solid;padding: 12px;margin: 5px;" id="largeLogo">
                              </div>

                              <div class="mb-3">
                                <label for="smallLogo" class="form-label">Small Logo</label>
                                <input type="file" class="form-control" id="smallLogo" name="smallLogo" >
                                <p class='info-text'>Suggested Size: 220x150 pixels</p>
                                <img  src='{{url('/')}}/@if(@isset($organization)){{$organization->smallLogo}} @endif' width='80px' style="border: 1px solid;padding: 12px;margin: 5px;"  id="smallLogo">
                              </div>

                              <div class="mb-3">
                                <label for="favicon" class="form-label">Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="favicon" >
                                <p class='info-text'>Suggested Size:32x32 pixels</p>
                                <img  src='{{url('/')}}/@if(@isset($organization)){{$organization->favicon}} @endif' width='80px' style="border: 1px solid;padding: 12px;margin: 5px;"  id="favicon">

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