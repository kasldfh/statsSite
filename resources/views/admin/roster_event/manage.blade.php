@extends('layouts.admin')

@section('js')

@endsection

@section('content')
    
	<h4 class="text">Manage Rosters at Event {!!$event->name!!}</h4>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Team</th>
                <th>Players</th>
                <th>Current</th>
                <th>Remove</th>
            </tr>
        </thead>

        <tbody>
        	@foreach($rosters as $roster)
            <tr>
                <td>{!!$roster->team->name!!}</td>
                <td> 
                  <ul class="list-group">
                  @foreach($roster->playermap as $player_map)
                    <li class="list-group-item">{!!$player_map->player->alias!!} {!!$player_map->starter ? "<span class='label label-primary pull-right'>Starter</span>":"<span class='label label-warning pull-right'>Sub</span>"!!}</li>
                  @endforeach
                  </ul>
                </td>
                <td>
                  @if($roster->current)
                    <span class="bg-success">Current Roster</span>
                  @elseif(!$roster->current)
                    <span class="bg-warning">Outdated Roster</span>
                  @endif
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{!!$roster->id!!}">Remove</button>
                </td>
            </tr>

            <div class="modal fade" id="{!!$roster->id!!}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to remove this {!!$roster->team->name!!} roster from {!!$event->name!!}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!!link_to_action('RosterEventController@store', 'Remove', ['roster_id' => $roster->id, 'event_id' => $event->id], ['class' => 'btn btn-danger'])!!}
                  </div>
                </div>
            </div>
        </div>
           	@endforeach
        </tbody>
	</table>
@endsection
