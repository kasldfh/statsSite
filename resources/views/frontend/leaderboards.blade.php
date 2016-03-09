@extends('layouts.frontend')
@section('title')
  Leaderboards
@stop

@section('scripts')
  <style type="text/css">
  table.sortable tbody {
      counter-reset: sortabletablescope;
  }
  table.sortable thead tr:before {
      content: "";
      display: table-cell;
  }
  table.sortable tbody tr:before {
    font-size:13px;
      content: counter(sortabletablescope);
      counter-increment: sortabletablescope;
      display: table-cell;
  }
  </style>
@stop

@section('banner')
  <h1>{!!$event->name!!} LEADERBOARD</h1>
@stop

@section('content')
  @include('frontend.leaderboard')
@stop
@section('loadlast')
<script src="/frontend_assets/js/sortable.js"></script>
@stop
