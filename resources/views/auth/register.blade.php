@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    @php
                        $items = [
                            "* Username" => ["username", "required", "text"],
                            "* Email" => ["email", "required", "email"],
                            "* Password" => ["password", "required", "password"],
                            "* Firstname" => ["firstname", "required", "text"],
                            "* Middlename" => ["middlename", "required", "text"],
                            "* Lastname" => ["lastname", "required", "text"],
                            "* Gender" => ["gender", "required", "dropdown"],
                            "* Contact No." => ["contact_no", "required", "number"],
                            "* Birthday" => ["birthday", "required", "date"],
                            "* Question" => ["question_id", "required", "dropdown"],
                            "* Answer" => ["security_answer", "required", "text"],
                            "Picture" => ["user_image", "", "", ""],
                        ];
                    @endphp

                    @foreach($items as $label => [$name, $isRequired, $type])
                        <div class="form-group row">
                            <label for="{{ $name }}" class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

                            <div class="col-md-6">
                                @if ($type == "dropdown")
                                    <select class="form-control" name="{{ $name }}" id="{{ $name }}" {{ $isRequired }}>
                                        @if ($name == "question_id")
                                            <option value="1">Who's your first pet?</option>
                                            <option value="2">Where is your first school?</option>
                                            <option value="3">What is your mother maiden name?</option>
                                        @else
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        @endif
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong name="{{ $name }}"></strong>
                                    </span>
                                @else
                                    <input
                                        type="{{ $type }}"
                                        class="form-control"
                                        name="{{ $name }}"
                                        id="{{ $name }}"
                                        {{ $isRequired }}
                                    >
                                    <span class="invalid-feedback" role="alert">
                                        <strong name="{{ $name }}"></strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
