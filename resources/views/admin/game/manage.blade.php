@extends('layouts.admin')
@section('style')
@endsection
@section('js')
<script>
 $(document).ready(function() {
    $('#games').dataTable({
  
    });
  });
</script>
@endsection
@section('content')
{{-- Note: based heavily on admin/match/manage.blade.php --}}
<h4 class="text">Manage Games</h4>
<table id="games" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Game</th>
            <th>Map</th>
            <th>Mode</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=0; ?>
    @foreach($games as $game)
        <?php $i++; ?>
        <tr>
            <td> {!! $i !!}</td>
            <td> {!! $game->map !!}</td>
            <td> {!! $game->mode !!}</td>
            <td> {!! link_to_action('GameController@edit', 'Edit', ['id' => $game->id], ['class' => 'btn btn-default']) !!} </td>
            <td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{!! $game->id !!}">Delete</button></td>
        </tr>
            
        <div class="modal fade" id="{!! $game->id !!}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete this map? </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! link_to_action('GameController@delete', 'Delete', ['id' => $game->id], ['class' => 'btn btn-primary']) !!}
              </div>
            </div>
          </div>
        </div>


    @endforeach
</tbody>
</table>
@endsection
