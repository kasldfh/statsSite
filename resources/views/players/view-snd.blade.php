@extends('layouts.main')

@section('style')
	
@endsection

@section('js')
<script>
 $(document).ready(function() {
var pieData = [
   {
      value: 60,
      label: 'A Plant Success',
      color: '#1738a6'
   },
   {
      value: 40,
      label: 'B Plant Success',
      color: '#a68517'
   },
];

var context = document.getElementById('skills').getContext('2d');
var skillsChart = new Chart(context).Pie(pieData);
 });
</script>
@endsection
@section('content')
<canvas id="skills" width="600" height="400"></canvas>


@endsection