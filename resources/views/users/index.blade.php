@extends('layouts.app')

@section('content')
<div class="container">

    <a class="btn btn-primary" href="{{ route('index.edit',$auth->id) }}">プロフィール編集</a>

    <form method="POST" action="{{ route('index.destroy',$auth->id) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">退会する</button>
    </form>

    <form method="GET" action="{{ route('search') }}">
        @csrf
        <div class="form-group row">
            <label for="id_name" class="col-md-4 col-form-label text-md-right">{{ __('名前検索：') }}</label>

            <div class="col-md-6">
                <input id="id_name" type="text" class="form-control" name="id_name" placeholder="学籍番号、氏名" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('場所検索：') }}</label>

            <div class="col-md-6">
                <input id="place" type="text" class="form-control" name="place" placeholder="場所" autofocus>
            </div>
        </div>

        <button type="submit" class="btn btn-success">
            {{ __('検索') }}
        </button>
    </form>

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
    <div class="d-flex justify-content-center my-5">
        {{ $users->links() }}
    </div>
</div>
@endsection