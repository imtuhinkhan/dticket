<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($ticket->title) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-12">
                            <h2 style="font-size: 24px;
                                padding: 10px;
                                margin-bottom: 14px;
                                font-weight: 600;
                            ">Details#{{$ticket->uniqueId}}</h2>
                            <table id="details">
                                <tr>
                                    <td>Ticket ID</td>
                                    <td>{{$ticket->uniqueId}}</td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>{{$ticket->title}}</td>
                                </tr>
                                <tr>
                                    <td>Service</td>
                                    <td>{{$ticket->service->name}}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{$ticket->category->name}}</td>
                                </tr>
                                <tr>
                                    <td>Priority</td>
                                    <td>{{$ticket->priority->name}}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{$ticket->description}}</td>
                                </tr>
                                <tr>
                                    <td>Current Status</td>
                                    <td>{{ticketStatus($ticket->status)}}</td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>{{$ticket->customer->name}}</td>
                                </tr>
                                <tr>
                                    <td>Last Replied By</td>
                                    <td>@if($ticket->lastReply){{$ticket->lastReply->name}}@endif</td>
                                </tr>
                                <tr>
                                    <td>Attachment</td>
                                    <td><img src="{{$ticket->image}}"/></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row reply-box">
                        <div class="col-sm-5 col-md-6 col-12 pb-4">
                            <div class="comment mt-4 text-justify float-left"> <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                                <h4>Jhon Doe</h4> <span>- 20 October, 2018</span> <br>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                                <img src="{{$ticket->image}}"/>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                            <form  method="POST" action="{{url('/')}}/replay/save">
                                @csrf
                                <div class="form-group">
                                    <h4>Reply to this ticket #{{$ticket->uniqueId}}</h4> <label for="message">Message</label> <textarea id="" msg cols="30" rows="5" class="form-control"  name="reply"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="catName" class="form-label">Screenshot</label>
                                    <input type="file" class="form-control" id="catName" name="photo">
                       
                                  </div>
                                <input type="hidden" name="ticketID" value="{{$ticket->id}}" />
                                <div class="form-group"> <button id="post" class="btn">Replay</button> </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>