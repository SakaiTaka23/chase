@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <canvas id="chart"></canvas>
    </div>
</div>

<canvas id="myChart" width="400" height="400"></canvas>
<script src="{{ mix('js/show_chart.js') }}"></script>

@endsection