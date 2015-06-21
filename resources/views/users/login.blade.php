
@extends('layouts.main')

@section('style')
	
@endsection

@section('js')

@endsection
@section('content')

	@if(Session::get('message', '') != '')
		<div class="alert-top">
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Error</strong> {{Session::pull('message')}}
		</div>
		</div>
	@endif
	{{ Form::open(array('action'=>'UsersController@attempt', 'class'=>'form-login')) }}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top form-bottom">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Admin Login</h4>
				</div>
			</div>
			<div class="row form-bottom">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					{{ Form::text('email', Input::old('email', '') , array('class'=>'form-control', 'placeholder'=>'Email')) }}
				</div>
			</div>
			<div class="row form-bottom">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    				{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    				{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary pull-right'))}}
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    				{{link_to_action('RemindersController@getRemind', 'Forgot your password?')}}
    			</div>
    		</div>
    	</div>
    </div>
    {{Form::close()}}
@endsection