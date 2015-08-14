@section('host')
    @if($match->event->type->name == "Online")
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
            <label for="host">Team Host</label>
            {{--{!!Form::label('host', 'Team Host')!!}--}}
            {!! Form::select('host', ['' => 'Please Select A Team Host'] + $match->teams,[$mode->team_host_id], ['id' => 'host', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
            {!!Form::label('p_host', 'Player Host')!!}
            {!!Form::select('p_host', ['' => 'Please Select A Player Host'] + $match->rostera->players + $match->rosterb->players, [$mode->pHost], ['class' => 'form-control'])!!}
            </div>
        </div>
    </div>
    @endif
@endsection
