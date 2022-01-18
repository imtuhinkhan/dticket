<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($tag) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-12">
                        <table id="table-1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Service</th>
                                    <th>Category</th>
                                    <th>Priority</th>
                                    <th>Created By</th>
                                    <th>Last Replied By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ticket as $key=>$data)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->service->name}}</td>
                                        <td>{{$data->category->name}}</td>
                                        <td>{{$data->priority->name}}</td>
                                        <td>{{$data->customer->name}}</td>
                                        <td>@if($data->lastReply!=null){{$data->lastReply->name}} @else {{'-'}} @endif</td>
                                        <td>
                                            @if($data->status==1 || $data->status==2)
                                            <a href="#" class="btn btn-success btn-sm">Close Resolved</a>
                                            <a href="#" class="btn btn-warning btn-sm">Close unsolved</a>
                                            @endif
                                            @if($data->status==3 || $data->status==4)
                                            <a href="#" class="btn btn-success btn-sm">Reopen</a>
                                            @endif
                                            <a href="#" class="btn btn-primary btn-sm">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Service</th>
                                    <th>Priority</th>
                                    <th>Created By</th>
                                    <th>Last Replied By</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
  <script type="text/javascript">
     $(document).ready(function() {
        $('#table-1').DataTable();
    });
  </script>
 
  @endsection
</x-admin-layout>