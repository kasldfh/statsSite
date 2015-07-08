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
	<h4 class="text">Manage Events</h4>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Event Name</th>
				<th>Game Title</th>
				<th>Event Type</th>
				<th></th>
            </tr>
        </thead>

        <tbody>
        	@foreach($events as $event)
            <tr>
                <td>{!!$event->name!!}</td>
				<td>{!!$event->title->title!!}</td>
				<td>{!!$event->type->name!!}</td>
				<td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{!!$event->id!!}">Delete</button></td>
            </tr>
            <div class="modal fade" id="{!!$event->id!!}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete {!!$event->name!!}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!!link_to_action('EventController@delete', 'Delete', ['id' => $event->id], ['class' => 'btn btn-primary'])!!}
                  </div>
                </div>
              </div>
            </div>
           	@endforeach
        </tbody>
	</table>
@endsection