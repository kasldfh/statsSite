@section('picks')
<div class="row" style="">
  <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
    <h4 type="text">Picks and Bans</h4>
  </div>

  <div class="" style="">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Player</th>
            <th>Pick or Ban</th>
            <th>Item</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i<=8; $i++)
          <tr>
            <td>{!!Form::select('pickers[]', ['' => 'Select'] + $match->rostera->players + $match->rosterb->players, $i <= 4 ? $match->rostera->starters[$i-1]->player_id : $match->rosterb->starters[$i-5]->player_id, ['class' => 'form-control'])!!}</td>
              {{--we expect this numbering in the gamecontroller store method--}}
              <td>{!! Form::select('pick_types[]', ['0' => 'Select', '1' => 'Protect', '2' => 'Ban', '3' => 'Missed', '4' => 'No Choice'], '', ['class'=>'form-control']) !!}</td>
              <td>{!! Form::select('pick_items[]', [''=>'Select'] + $items->toArray(), '',  ['class'=>'form-control']) !!}</td>
          </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
@stop

