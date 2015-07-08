
@extends('layouts.main')

@section('style')
	
@endsection

@section('js')

@endsection
@section('content')
	{!! Form::open(array('action'=>'RemindersController@postRemind', 'class'=>'form-login', 'id' => 'form')) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Forgot Password?</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('email', 'Email')!!}
					{!! Form::email('email', '' , array('class'=>'form-control', 'placeholder'=>'Email', 'data-fv-notempty' => 'true')) !!}
					</div>
				</div>
			</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
    				{!! Form::submit('Send Email', array('class'=>'btn btn-large btn-primary pull-right'))!!}
    				{!! HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) !!}
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    {!!Form::close()!!}
@endsection