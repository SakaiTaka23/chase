@extends('layouts.app')

@section('content')
<div class="container">

    <a class="btn btn-primary" href="index/{{ $auth->id }}/edit">プロフィール編集</a>

    <div class="row justify-content-center">

        <table class="table-bordered">
            <tr>
                <th>学籍番号</th>
                <th>氏</th>
                <th>名</th>
                <th>場所</th>
                <th>更新日</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->student_id }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->place }}</td>
                <td>{{ $user->updated_at->format('m/d H:i') }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection