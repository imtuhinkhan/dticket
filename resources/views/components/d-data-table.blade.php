<div class="card">
    <div class="card-header bg-info ">{{$attributes['header']}} 
        @if($attributes['add-new']==1)
        <x-d-add-new-item-button :tag="$attributes['tag']"/>
        @endif
    </div>
    <table id="table-1" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sl</th>
                @foreach ($attributes['theader'] as $item)
                    <th>{{$item}}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes['data'] as $key=>$data)
                <tr>
                    <th>{{++$key}}</th>

                    @foreach ($attributes['theader'] as $item)
                    @if($item=='Photo')
                    <th><img  src='{{url('/')}}/{{$data['photo']}}' width="50px" /></th>

                    @else
                    <th>{!!$data[strtolower($item)]!!}</th>
                    @endif
                    @endforeach

                    <th>
                        <a  href="{{url('/')}}/{{$attributes['tag']}}/{{$data['id']}}/edit"><i class="fas fa-pencil" title="Delete" style="color: rgb(233, 145, 14)"></i></a>
                        @if($data['is_active']==1)
                        <a onclick="return confirm('Are you sure you want to deactive this item')"  href="{{url('/')}}/{{$attributes['tag']}}/{{$data['id']}}/delete"><i class="fas fa-trash danger show_confirm" data-tag="{{$attributes['tag']}}" data-id={{$data['id']}} style="color: rgb(228, 39, 49);cursor: pointer;" title="deactive"></i></a>
                        @endif
                    </th>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sl</th>

                @foreach ($attributes['theader'] as $item)
                    <th>{{$item}}</th>
                @endforeach
                <th>Action</th>

            </tr>
        </tfoot>
    </table>
  </div>

  @section('script')
  <script type="text/javascript">
     $(document).ready(function() {
        $('#table-1').DataTable();
        // $(document).on('click','.show_confirm',function(event) {
        //     var id = $(this).data('id');
        //     var tag = $(this).data('tag');
        //     swal({
        //         title: `Are you sure you want to delete this record?`,
        //         text: "If you delete this, it will be gone forever.",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //         if(willDelete){
        //             console.log(id,tag)
        //         $.ajax({
        //                 url: "{{url('/')}}"+tag+'/delete/'+id,
        //                 type: "GET",
        //                 success: function (data) {
        //                     console.log(data)
        //                 }         
        //             });
        //         }
        //     });
        // });

    });
  </script>
 
  @endsection
