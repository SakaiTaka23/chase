@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('場所変更画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('place.update',[$auth->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('現在地') }}</label>

                            <div class="col-md-6">
                                <input id="place" type="text" class="form-control @error('place') is-invalid @enderror"
                                    name="place" value="{{ $auth->place }}" required autocomplete="place" autofocus>

                                @error('place')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('変更') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection