@extends('layouts.admin')

@section('style')
	
@endsection

@section('js')

@endsection
@section('content')
	{!! Form::open(array('action'=>'ItemController@store', 'class'=>'form-login', 'id' => 'form')) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Create Item</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('name', 'Item Name')!!}
					{!! Form::text('name', '' , array('class'=>'form-control', 'placeholder'=>'Item Name', 'data-fv-notempty' => 'true')) !!}
					</div>
				</div>
			</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('game', 'Game Title')!!}
    				{!! Form::select('game', ['' => 'Please Select A Game Title'] + $games->lists('title', 'id')->all(), [], array('class'=>'form-control', 'data-fv-notempty' => 'true')) !!}
    				</div>
    			</div>
    		</div>

    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('type', 'Item Type')!!}
    				{!! Form::select('type', ['Please Select An Item Type'] + $item_types, [], array('class'=>'form-control')) !!}
    				</div>
    			</div>
    		</div>

    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
    				{!! Form::submit('Create', array('class'=>'btn btn-large btn-primary pull-right'))!!}
    				{!! HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) !!}
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    {!!Form::close()!!}
@endsection

