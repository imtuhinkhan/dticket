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

                    <th>{!!$data[strtolower($item)]!!}</th>
                    @endforeach

                    <th>
                        <a href="/{{$attributes['tag']}}/{{$data['id']}}/edit"><i class="fas fa-pencil" title="Delete" style="color: rgb(233, 145, 14)"></i></a>
                        @if($data['is_active']==1)
                        <a href="/{{$attributes['tag']}}/{{$data['id']}}/delete"><i class="fas fa-trash danger" style="color: rgb(228, 39, 49)" title="Delete"></i></a>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
    $('#table-1').DataTable();
    });
    </script>