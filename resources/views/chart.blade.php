@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <canvas id="chart"></canvas>
    </div>
</div>

<canvas id="myChart" width="400" height="400"></canvas>

{{-- <script>
    var ctx = document.getElementById('chart').getContext('2d');
    var keys = '{{ $keys }}';
var count = '{{ $counts }}';
var chart = new Chart(ctx, {
type: 'pie',

data: {
labels: keys,
datasets: [{
label: '学生居場所割合',
backgroundColor:
[
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor:
[
'rgba(255, 99, 132, 1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
data: count,
}]
},

options: {
title: {
display: true,
text: '学生居場所割合',
fontSize: 30,
}
}
});
</script> --}}
@endsection

<script src="{{ mix('js/show_chart.js') }}"></script>