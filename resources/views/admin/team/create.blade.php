@extends('layouts.admin')

@section('style')
	
@endsection

@section('js')
<script>
    $(function(){
      	$("#logo").fileinput({showUpload: false, maxFileCount: 10, mainClass: "input-group-lg"});
    });


</script>
@endsection
@section('content')
	{!! Form::open(array('action'=>'TeamController@store', 'class'=>'form-login', 'id' => 'form', 'files' => true)) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Create Team</h4>
				</div>
			</div>
			 <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('name', 'Team Name')!!}
					{!! Form::text('name', '' , array('class'=>'form-control', 'placeholder'=>'Team Name', 'data-fv-notempty' => 'true')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('owner1', 'Owner')!!}
					{!! Form::text('owner1', '' , array('class'=>'form-control', 'placeholder'=>'Owner', 'data-fv-notempty' => 'true')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('owner2', 'Owner 2')!!}
					{!! Form::text('owner2', '' , array('class'=>'form-control', 'placeholder'=>'Owner 2')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('twitter', 'Twitter')!!}
					{!! Form::text('twitter', '' , array('class'=>'form-control', 'placeholder'=>'Twitter')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('youtube', 'Youtube')!!}
					{!! Form::text('youtube', '' , array('class'=>'form-control', 'placeholder'=>'Youtube')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('twitch', 'Twitch')!!}
					{!! Form::text('twitch', '' , array('class'=>'form-control', 'placeholder'=>'Twitch')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('mlg_tv', 'Mlg.tv')!!}
					{!! Form::text('mlg_tv', '' , array('class'=>'form-control', 'placeholder'=>'Mlg.tv')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('web_url', 'Website')!!}
					{!! Form::text('web_url', '' , array('class'=>'form-control', 'placeholder'=>'Website')) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('color', 'Color')!!}
					<input name="color" type="color" class="form-control" data-fv-notempty='true'/>
					   
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						{!!Form::label('logo', 'Logo')!!}
						<input id="logo" name="logo" type="file" class="file">
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
