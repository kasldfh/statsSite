@extends('layouts.main')

@section('style')
	
@endsection

@section('js')
<script>
 $(document).ready(function() {
    $('#example').dataTable({
       "scrollX": true
    });
  });
</script>
@endsection
@section('content')
	<h4 class="text">Manage Teams</h4>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Team Name</th>
        				<th>Owner</th>
        				<th>Owner 2</th>
                <th>Twitter</th>
                <th>YouTube</th>
                <th>Twitch</th>
                <th>Mlg.tv</th>
                <th>Website</th>
                <th>Color</th>
                <th>Logo</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        	@foreach($teams as $team)
            <tr>
                <td>{!!$team->name!!}</td>
				        <td>{!!$team->owner1!!}</td>
                <td>
                  @if(!empty($team->owner2))
                    {!!$team->owner2!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($team->twitter))
                    {!!$team->twitter!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($team->youtube))
                    {!!$team->youtube!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($team->twitch))
                    {!!$team->twitch!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($team->mlg_tv))
                    {!!$team->mlg_tv!!}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($team->web_url))
                    {!!$team->web_url!!}
                  @else
                    -
                  @endif
                </td>
                <td><div class="color-swatch" style="background-color: {!!$team->team_color!!};"></div></td>
                <td>
                  @if(!empty($team->logo_url))
                  <img src="{!!$team->logo_url!!}" width="50">
                  @else
                    -
                  @endif
                  </td>
				        <td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{!!$team->id!!}">Delete</button></td>
            </tr>
            <div class="modal fade" id="{!!$team->id!!}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete {!!$team->name!!}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!!link_to_action('TeamController@delete', 'Delete', ['id' => $team->id], ['class' => 'btn btn-primary'])!!}
                  </div>
                </div>
              </div>
            </div>
           	@endforeach
        </tbody>
	</table>
@endsection