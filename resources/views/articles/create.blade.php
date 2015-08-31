@extends('articles.app')

@section('content')
	<h1>Write a new Article</h1>
	<hr/>
	{!! Form::open(['url' => 'articles']) !!}
		@include('articles.form', ['submitButtonText' => 'Add article'])


	{!! Form::close() !!}

	@include('errors.list')

@stop
