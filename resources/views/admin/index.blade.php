@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-center row">

                {{ $users->appends(request()->query())->links('vendor/pagination/pagination_view') }}

                <table class="table table-hover mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th>学籍番号</th>
                            <th>氏</th>
                            <th>名</th>
                            <th>場所</th>
                            <th>更新日</th>
                            <th>編集</th>
                            <th>削除</th>
                            <th>任命</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->student_id }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->place }}</td>
                            <td>{{ $user->updated_at->format('m/d H:i') }}</td>
                            <td><a href="">編集</a></td>
                            <td><a href="">削除</a></td>
                            <td><a href="">任命</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection