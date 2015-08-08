@extends('layouts.main')
@section('admin')
    @if(Auth::check())
    <li>{!!link_to_action('AdminController@dashboard', 'Admin', [], [])!!}</li>
    @endif
    </ul>
    <ul class="nav navbar-nav navbar-right" style="">
    
      @if(Auth::check())

      <li>{!!link_to_action('UsersController@logout', 'Logout ' . Auth::user()->email, [], [])!!}</li>
      @endif
@endsection
