@extends('layouts.main')

@section('style')
	
@endsection

@section('js')
<script>
    $(function(){
      	$("#logo").fileinput({showUpload: false, maxFileCount: 10, mainClass: "input-group-lg"});
    });
  	$('#date').datetimepicker({
                    format: 'L'
                });
  	$('#country').select2();
  	$('#date')
	.on('dp.change dp.show', function (e) {
	    // Revalidate the date when user change it
	    $('#form').formValidation('revalidateField', 'date');
	});



</script>
@endsection
@section('content')
	{{ Form::open(array('action'=>'PlayerController@store', 'class'=>'form-login', 'id' => 'form', 'files' => true)) }}
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
					{{Form::label('first_name', 'First Name')}}
					{{ Form::text('first_name', '' , array('class'=>'form-control', 'placeholder'=>'First Name')) }}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('last_name', 'Last Name')}}
					{{ Form::text('last_name', '' , array('class'=>'form-control', 'placeholder'=>'Last Name')) }}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('alias', 'Alias')}}
					{{ Form::text('alias', '' , array('class'=>'form-control', 'placeholder'=>'Alias', 	'data-fv-notempty' => 'true')) }}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('country', 'Country')}}
					<select id="country" name="country" class="form-control select2">
						<option value="US">United States</option>
		                <option value="AT">Austria</option>
		                <option value="BG">Bulgaria</option>
		                <option value="BR">Brazil</option>
		                <option value="CA">Canada</option>
		                <option value="CZ">Czech Republic</option>
		                <option value="DK">Denmark</option>
		                <option value="FR">French</option>
		                <option value="DE">Germany</option>
		                <option value="IN">India</option>
		                <option value="IT">Italy</option>
		                <option value="IE">Ireland</option>
		                <option value="MA">Morocco</option>
		                <option value="NL">Netherlands</option>
		                <option value="PL">Poland</option>
		                <option value="PT">Portugal</option>
		                <option value="RO">Romania</option>
		                <option value="RU">Russia</option>
		                <option value="SG">Singapore</option>
		                <option value="SK">Slovakia</option>
		                <option value="ES">Spain</option>
		                <option value="SE">Sweden</option>
		                <option value="CH">Switzerland</option>
		                <option value="GB">United Kingdom</option>
					</select>
					</div>
				</div>
			</div>



			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('zipcode', 'Hometown (Zip Code or Postal Code)')}}
					{{ Form::text('zipcode', '' , array('class'=>'form-control', 'placeholder'=>'Hometown')) }}
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('date', 'Date of Birth')}}
					<div class='input-group date' id='date'>
					<input type='text' name="date" class="form-control" />
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						{{Form::label('logo', 'Player Headshot')}}
						<input id="logo" name="logo" type="file" class="file">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{ Form::submit('Create', array('class'=>'btn btn-large btn-primary pull-right'))}}
					{{ HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) }}
					</div>
				</div>
			</div>

    	</div>
    </div>
   
    {{Form::close()}}
@endsection