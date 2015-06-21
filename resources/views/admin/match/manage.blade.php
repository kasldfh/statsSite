
@extends('layouts.main')

@section('style')
    
@endsection

@section('js')
<script>
 $(document).ready(function() {
    $('#example').dataTable({
  
    });
  });
</script>
@endsection
@section('content')
    <h4 class="text">Manage Matches</h4>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Team A</th>
                <th>Team B</th>
                <th>A Map Count</th>
                <th>B Map Count</th>
                <th>Event Name</th>
                <th>Match Type</th>
                <th>Score Type</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($matches as $match)
            <tr>
                <td>{{$match->rostera->team->name}}</td>
                <td>{{$match->rosterb->team->name}}</td>
                <td>
                  @if(!empty($match->a_map_count))
                    {{$match->a_map_count}}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($match->b_map_count))
                    {{$match->b_map_count}}
                  @else
                    -
                  @endif
                </td>
                <td>{{$match->event->name}}</td>
                <td>{{$match->type->name}}</td>
                <td>{{$match->score->name_short}}</td>
                <td>
                  @if($match->score_type_id != 3)
                  {{link_to_action('GameController@create', 'Add Map', ['id' => $match->id], ['class' => 'btn btn-default'])}}
                  @endif
                </td>
                <td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{{$match->id}}">Delete</button></td>
            </tr>
            <div class="modal fade" id="{{$match->id}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete the match of {{$match->rostera->team->name}} vs. {{$match->rosterb->team->name}}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{link_to_action('MatchController@delete', 'Delete', ['id' => $match->id], ['class' => 'btn btn-primary'])}}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </tbody>
    </table>
@endsection