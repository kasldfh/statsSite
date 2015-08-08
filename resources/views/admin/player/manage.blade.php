@extends('layouts.admin')

@section('style')
	
@endsection

@section('js')
<script>
 $(document).ready(function() {
    $('#example').dataTable({
       // "scrollX": true
    });
  });
</script>
@endsection
@section('content')
	<h4 class="text">Manage Players</h4>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Alias</th>
        				<th>First Name</th>
        				<th>Last Name</th>
                <th>Hometown (Postal Code)</th>
                <th>Country</th>
                <th>Headshot</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        	@foreach($players as $player)
            <tr>
                <td>{!!$player->alias!!}</td>
                <td>
                  @if(!empty($player->first_name))
                    {!!$player->first_name!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($player->last_name))
                    {!!$player->twitter!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($player->hometown))
                    {!!$player->hometown!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($player->country))
                    {!!$player->country!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($player->photo_url))
                    <img src="{!!$player->photo_url!!}" width="50">
                  @else
                    -
                  @endif
                </td>
				        <td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{!!$player->id!!}">Delete</button></td>
            </tr>
            <div class="modal fade" id="{!!$player->id!!}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete {!!$player->alias!!}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!!link_to_action('PlayerController@delete', 'Delete', ['id' => $player->id], ['class' => 'btn btn-primary'])!!}
                  </div>
                </div>
              </div>
            </div>
           	@endforeach
        </tbody>
	</table>
@endsection