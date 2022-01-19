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
                             
                             <div style="float:right;margin:10px">
                                @if($ticket->status==1 || $ticket->status==2)
                                    <a href="/ticket/{{$ticket->id}}/changeStatus/3" class="btn btn-success btn-sm">Mark Close & Resolved</a>
                                    <a href="/ticket/{{$ticket->id}}/changeStatus/4" class="btn btn-warning btn-sm">Mark Close & Unsolved</a>
                                @else 
                                <a href="/ticket/{{$ticket->id}}/changeStatus/2" class="btn btn-danger btn-sm">Reopen</a>
                                @endif
                             </div> 
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
                                    <td><img src="/{{$ticket->image}}" style="width:25%;"/></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row reply-box">
                  <h1 style="color:red;">Ticket Replies</h1>

                        @if($ticket->status==1 || $ticket->status==2)
                        <div class="col-sm-5 col-md-6 col-12 pb-4">
                        @else
                        <div class="col-sm-12 col-md-12 col-12 pb-4">
                        @endif
                            @foreach($ticket->comments as $row=>$val)
                                <div class="comment mt-4 text-justify float-left"> <img src="/{{$val->user->userDetails->photo}}" alt="" class="rounded-circle" width="40" height="40">
                                    <h4>{{$val->user->name}}</h4> <span>- {{timeConvert($val->created_at)}}</span> <br>
                                    <p>{{$val->reply}}</p>
                                    @if($val->image)
                                    <a href="/{{$val->image}}"  download>Download Attachement</a>
                                    @endif
                                    
                                </div>
                            @endforeach

                        </div>
                        @if($ticket->status==1 || $ticket->status==2)
                        <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                            <form  method="POST" action="{{url('/')}}/replay/save" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h4>Reply to this ticket #{{$ticket->uniqueId}}</h4> <label for="message">Message</label> <textarea id="" msg cols="30" rows="5" class="form-control"  name="reply"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="catName" class="form-label">Attachement</label>
                                    <input type="file" class="form-control" id="catName" name="photo">
                       
                                  </div>
                                <input type="hidden" name="ticketID" value="{{$ticket->id}}" />
                                <div class="form-group"> <button id="post" class="btn">Replay</button> </div>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>