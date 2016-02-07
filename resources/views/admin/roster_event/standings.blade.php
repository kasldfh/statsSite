@extends('layouts.admin')
@section('content')
	<h4 class="text">Manage standings at {!!$event->name!!}</h4>
  {!! Form::open(['action'=>'RosterEventController@update_standings', 'class'=>'form']) !!}
    <div class="form-group">
    <input type="hidden" name="event_id" value="{!!$event->id!!}">
	    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Team</th>
            <th>Standing</th>
          </tr>
        </thead>

        <tbody>
          @foreach($roster_events as $roster_event)
            <tr>
              <td>{!!$roster_event->roster->team->name!!}</td>
              <td>
                <input type="text" name="{!!$roster_event->id!!}" class="form-control" value="{!!$roster_event->placing!!}">
              </td>
            </tr>
          @endforeach
        </tbody>
	    </table>
      <button type="submit" class="btn btn-primary">Update Standings</button>
    </div>
  {!!Form::close()!!}
@endsection
