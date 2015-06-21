@extends('layouts.main')

@section('style')
	
@endsection

@section('js')
<script>
 $(document).ready(function() {
   var sndplants = {{json_encode($sndFirstBlood)}};
   

var pieData = [
   {
      value: sndplants[0]['first_bloods'],
      label: sndplants[0]['player_name'],
      labelColor : 'black',
      labelFontSize : '16',
      color: '#1DF20A'
   },
      {
      value: sndplants[1]['first_bloods'],
      label: sndplants[1]['player_name'],
      labelColor : 'black',
      labelFontSize : '16',
      color: '#1DF20A'
   },
      {
      value: sndplants[2]['first_bloods'],
      label: sndplants[2]['player_name'],
      labelColor : 'black',
      labelFontSize : '16',
      color: '#1738a6'
   },
      {
      value: sndplants[3]['first_bloods'],
      label: sndplants[3]['player_name'],
      labelColor : 'black',
      labelFontSize : '16',
      color: '#1738a6'
   },
];
console.log(pieData);

var context = document.getElementById('skills').getContext('2d');
var skillsChart = new Chart(context).Pie(pieData);
 });
</script>
@endsection
@section('content')
<canvas id="skills" width="600" height="400"></canvas>


@endsection