@section('buttons')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
            {!! Form::submit('Update Map', array('class'=>'btn btn-large btn-primary pull-right'))!!}
            {!! HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) !!}
            </div>
        </div>
    </div>
@endsection
