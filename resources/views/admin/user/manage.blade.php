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
 $(document).ready(function() {
    $('#example2').dataTable({
       "bFilter": false,
      "bPaginate": false,
      "bInfo" : false
    });
  });
</script>
@endsection
@section('content')
	<h4 class="text">Manage Admins</h4>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
        				<th>Email</th>
        				<th>Access Level</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        	@foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
				        <td>{{$user->email}}</td>
                <td>
                  @if($user->super)
                    Universal
                  @else
                    Default
                  @endif
                </td>
				        <td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#{{$user->id}}">Delete</button></td>
            </tr>
            <div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete {{$user->name}}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{link_to_action('SuperController@delete', 'Delete', ['id' => $user->id], ['class' => 'btn btn-primary'])}}
                  </div>
                </div>
              </div>
            </div>
           	@endforeach
        </tbody>
	</table>
  <h4 class="text">Manage Unregistered Admins</h4>
  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Access Level</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
          @foreach($other_users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                  @if($user->admin)
                    Universal
                  @else
                    Default
                  @endif
                </td>
                <td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#other{{$user->id}}">Delete</button></td>
            </tr>
            <div class="modal fade" id="other{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete {{$user->name}}?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{link_to_action('SuperController@deleteConfirm', 'Delete', ['id' => $user->id], ['class' => 'btn btn-primary'])}}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </tbody>
  </table>
@endsection