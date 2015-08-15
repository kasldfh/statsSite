@extends('layouts.main')

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
	<h4 class="text">Add Roster to Event {!!$event->name!!}</h4>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Team</th>
                <th>Players</th>
                <th>Current</th>
                <th>Add to Event</th>
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
                    Current
                  @endif
                </td>
                    <td>
                        {!! Form::open(['action' => ['RosterEventController@store', $event->id], 'class' => 'form-inline']) !!}
                        {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </td>
            </tr>
           	@endforeach
        </tbody>
	</table>
@endsection
