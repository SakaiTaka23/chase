@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>全員の居場所</h3>
        <canvas id="allChart"></canvas>
    </div>
</div>

<script src="{{ mix('js/show_chart.js') }}"></script>
<script>
    window.id = 'allChart';
    window.labels = @json($keys);
    window.data = @json($counts);
    window.make_chart(window.id,window.labels,window.data);
</script>

@endsection