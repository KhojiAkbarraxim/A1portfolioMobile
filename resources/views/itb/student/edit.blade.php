@extends('layouts/admin')

@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $student->name }} - tahrirlash
            </h6>
        </div>
        <div class="card-body">
            @include('itb.alerts.main')
            <form method="POST" enctype="multipart/form-data" action="{{ route('student.update', $student->id) }}">
                @csrf
                @method('PUT')
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                            <label>Guruh:<span style="color:red;">*</span></label>
                            <select class="form-control" name="group_id" required="required">
                                @foreach ($groups as $group)
                                    <option value="{{$group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Ism familyasi:</label>
                            <input value="{{ $student->name }}" class="form-control" name="name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Telefon raqami:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">+998</span>
                                </div>
                                <input type="number" class="form-control" value="{{$phone_str}}" name="phone"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Login:</label>
                            <input value="{{ $student->login }}" class="form-control" name="email" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">Parol:</label>
                            <input value="{{ $student->parol }}" class="form-control" name="password" type="text">
                        </div>
                        <button type="submit" class="btn btn-success">Saqlash</button>
                    </div>

            </form>
        </div>
    </div>
@endsection
