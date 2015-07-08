@extends('layouts.main')

@section('style')
    
@endsection

@section('js')
<script>
 $(document).ready(function() {
    $('#example').dataTable({
        "bFilter": false,
        "bPaginate": false,
        "bInfo" : false
    });
  });
</script>
@endsection
@section('content')
    <h4 class="text">Manage Game Titles</h4>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Game Title</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($game_titles as $game_title)
            <tr>
                <td>{!!$game_title->title!!}</td>
                <td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{!!$game_title->id!!}">Delete</button></td>
            </tr>
            <div class="modal fade" id="{!!$game_title->id!!}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete {!!$game_title->title!!}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!!link_to_action('GameTitleController@delete', 'Delete', ['id' => $game_title->id], ['class' => 'btn btn-primary'])!!}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </tbody>
    </table>
@endsection