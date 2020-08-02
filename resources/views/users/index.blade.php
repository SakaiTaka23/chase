@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row d-flex justify-content-between mb-4">
        <a class="btn btn-primary" href="{{ route('index.edit',$auth->id) }}">プロフィール編集</a>

        <a class="btn btn-primary" href="{{ route('place.edit',$auth->id) }}">場所変更</a>

        <form method="POST" action="{{ route('index.destroy',$auth->id) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">退会する</button>
        </form>
    </div>

    <form method="GET" action="{{ route('search.index') }}"
        class="row d-flex justify-content-around align-items-baseline">
        @csrf
        <div class="d-flex justify-content-end">
            <div class="form-group row">
                <label for="id_name" class="col-md-4 col-form-label text-md-right">{{ __('名前検索：') }}</label>

                <div class="col-md-6">
                    <input id="id_name" type="text" class="form-control" name="id_name" placeholder="学籍番号 氏 名"
                        value="{{ $id_name ?? ''}}" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('場所検索：') }}</label>

                <div class="col-md-6">
                    <input id="place" type="text" class="form-control" name="place" placeholder="場所"
                        value="{{ $place ?? ''}}" autofocus>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mr-5">
            {{ __('検索') }}
        </button>
    </form>

    <div class="row d-flex justify-content-around align-items-baseline">
        @if ($count == 0)
        <h3 class="text-primary ml-3">その条件では見つかりませんでした</h3>
        @else
        <h3 class="text-primary ml-3">{{ $count }}件見つかりました</h3>
        @endif

        {{ $users->appends(request()->query())->links('vendor/pagination/pagination_view') }}

        <a class="btn btn-info" href="{{ route('place.index') }}">割合を表示</a>
    </div>

    <div class="d-flex justify-content-center row">

        <table class="table table-hover mt-2">
            <thead class="thead-light">
                <tr>
                    <th>学籍番号</th>
                    <th>氏</th>
                    <th>名</th>
                    <th>場所</th>
                    <th>更新日</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection