@extends('layouts.admin')

@section('style')

@endsection

@section('js')
<script>
$( document ).ready(function() {
    $(".to_hide").hide();
    var score_type = parseInt({!!$match->score_type_id!!});
    score_type = 1;
    var options = {!!json_encode($mode_map)!!};
    $("body").on("change", "#mode", function() {
        var value = parseInt($(this).val());
        var selected = $('option:selected', $(this)).text();
        console.log(options);
        var $el = $("#map");
        $el.empty(); // remove old options
        $.each(options[value], function(value,key) {
            $el.append($("<option></option>")
                .attr("value", value).text(key));
        });
        if(selected  === "Search and Destroy") {
            $(".to_hide").hide();
            $(".snd_score").show();
            if(score_type == 1) {
                $(".snd_div").show();
            }
        } else if(selected  === "Capture the Flag") {
            $(".to_hide").hide();
            $(".ctf_score").show();
            if(score_type == 1) {
                $(".ctf_div").show();
            }
        } else if(selected  === "Uplink") {
            $(".to_hide").hide();
            $(".uplink_score").show();
            if(score_type == 1) {
                $(".uplink_div").show();
            }
        } else if(selected === "Hardpoint") {
            $(".to_hide").hide();
            $(".hp_score").show();
            if(score_type == 1) {
                $(".hp_div").show();
            }
        }
    });
});

</script>
@endsection
@section('Delete')

@foreach ($match->rostera->players as $playerid => $player)
{!!$player!!}
{!!$playerid!!}
<br>
@endforeach

@endsection
@section('content')
    {!! Form::open(array('action'=>'GameController@store', 'class'=>'form-login', 'id' => 'form')) !!}
    <input type="hidden" name="match_id" value="{!!$match->id!!}">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row form-top">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 class="text">Create Game</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5 class="text">{!!$match->rostera->team->name!!} vs. {!!$match->rosterb->team->name!!} at {!!$match->event->name!!}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    {!!Form::label('mode', 'Mode')!!}
                    {!! Form::select('mode', ['' => 'Please Select A Mode'] + $modes->lists('name', 'id')->all(),[], ['id' => 'mode', 'class' => 'form-control', 'data-fv-notempty' => 'true']) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    {!!Form::label('map', 'Map')!!}
                    {!! Form::select('map', ['' => 'Please Select A Map'], [], ['id' => 'map', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                    <label for="minutes">Minutes</label>
                    <input type="text" name="minutes" class="form-control">
                    </div>
                </div>

                <div class="col-xs-2">
                    <div class="form-group">
                    <label for="seconds">Seconds</label>
                    <input type="text" name="seconds" class="form-control">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                    <label for="game_num">Game Number</label>
                    <input type="text" name="game_num" class="form-control">
                    </div>
                </div>
                </div>
            </div>
            @if($match->event->type->name == "Online")
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    {!!Form::label('host', 'Team Host')!!}
                    {!! Form::select('host', ['' => 'Please Select A Team Host'] + $match->teams,[], ['id' => 'host', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    {!!Form::label('p_host', 'Player Host')!!}
                    {!!Form::select('p_host', ['' => 'Please Select A Player Host'] + $match->rostera->players + $match->rosterb->players, [], ['class' => 'form-control'])!!}
                    </div>
                </div>
            </div>
            @endif
                <div class="row to_hide snd_div" style="display:none;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>First Blood</th>
                                <th>Planter</th>
                                <th>Site</th>
                                <th>Victor</th>
                                <th>Side Won</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i<=11; $i++)
                            <tr>
                                <td><h5 class="text">Round {!!$i!!}</h5></td>
                                <td>{!!Form::select('fb[]', ['' => 'Select'] + $match->rostera->players + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('planter[]', ['' => 'Select'] +  $match->rostera->players + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('site[]', ['' => 'Select', 'a' => 'A', 'b' => 'B'], [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('victor[]', ['' => 'Select'] +  $match->teams, [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('side[]', ['' => 'Select', 'o' => 'Offense', 'd' => 'Defense'], [], ['class' => 'form-control'])!!}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                </div>
                <div class="row to_hide snd_div snd_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rostera->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('a_score', '' , array('class'=>'form-control', 'placeholder'=>'Round Count')) !!}
                    </div>
                </div>
                <div class="row to_hide snd_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Plants</th>
                                    <th>Defuses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('aplayers[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('plants[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('defuses[]', '' , array('class'=>'form-control')) !!}</td>

                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row to_hide snd_div snd_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rosterb->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('b_score', '' , array('class'=>'form-control', 'placeholder'=>'Round Count')) !!}
                    </div>
                </div>
                <div class="row to_hide snd_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Plants</th>
                                    <th>Defuses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('bplayers[]', ['' => 'Select'] + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('plants[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('defuses[]', '' , array('class'=>'form-control')) !!}</td>

                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row to_hide ctf_div ctf_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rostera->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('a_ctf_score', '' , array('class'=>'form-control', 'placeholder'=>'Captures')) !!}
                    </div>
                </div>
                <div  class="row to_hide ctf_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Captures</th>
                                    <th>Defends</th>
                                    <th>Returns</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('ctf_player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('ctf_kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('ctf_deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('ctf_captures[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('ctf_defends[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('returns[]', '' , array('class'=>'form-control')) !!}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div  class="row to_hide ctf_div ctf_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rosterb->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('b_ctf_score', '' , array('class'=>'form-control', 'placeholder'=>'Captures')) !!}
                    </div>
                </div>
                <div  class="row to_hide ctf_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Captures</th>
                                    <th>Defends</th>
                                    <th>Returns</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('ctf_player[]', ['' => 'Select'] + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('ctf_kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('ctf_deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('ctf_captures[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('ctf_defends[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('returns[]', '' , array('class'=>'form-control')) !!}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row to_hide uplink_div uplink_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rostera->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('a_uplink_score', '' , array('class'=>'form-control', 'placeholder'=>'Uplinks')) !!}
                    </div>
                </div>
                <div class="row to_hide uplink_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Uplinks</th>
                                    <th>Makes</th>
                                    <th>Misses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('uplink_player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('uplink_kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('uplink_deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('uplinks[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('shots[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('misses[]', '' , array('class'=>'form-control')) !!}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row to_hide uplink_div uplink_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rosterb->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('b_uplink_score', '' , array('class'=>'form-control', 'placeholder'=>'Uplinks')) !!}
                    </div>
                </div>
                <div class="row to_hide uplink_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Uplinks</th>
                                    <th>Makes</th>
                                    <th>Misses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('uplink_player[]', ['' => 'Select'] + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('uplink_kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('uplink_deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('uplinks[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('shots[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('misses[]', '' , array('class'=>'form-control')) !!}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row to_hide hp_div hp_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rostera->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('a_hp_score', '' , array('class'=>'form-control', 'placeholder'=>'Score')) !!}
                    </div>
                </div>
                <div class="row to_hide hp_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Captures</th>
                                    <th>Defends</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('hp_player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('hp_kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_captures[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_defends[]', '' , array('class'=>'form-control')) !!}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row to_hide hp_div hp_score" style="display:none;">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rosterb->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::text('b_hp_score', '' , array('class'=>'form-control', 'placeholder'=>'Score')) !!}
                    </div>
                </div>
                <div class="row to_hide hp_div" style="display:none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Captures</th>
                                    <th>Defends</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    <td>{!!Form::select('hp_player[]', ['' => 'Select'] + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('hp_kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_captures[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_defends[]', '' , array('class'=>'form-control')) !!}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                    {!! Form::submit('Add Map', array('class'=>'btn btn-large btn-primary pull-right'))!!}
                    {!! HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection

