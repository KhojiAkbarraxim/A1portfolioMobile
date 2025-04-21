@extends('layouts/admin')

@section('content')
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $professor->name }} - tahrirlash
            </h6>
        </div>
        <div class="card-body">
            @include('itb.alerts.main')
            <form method="POST" enctype="multipart/form-data" action="{{ route('professor.update', $professor->id) }}">
                @csrf
                @method('PUT')
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                            <label>Kafedrasi:<span style="color:red;">*</span></label>
                            <select class="form-control" name="department_id" required="required">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Ism familyasi:</label>
                            <input value="{{ $professor->getUser->name }}" class="form-control" name="name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">Login:</label>
                            <input value="{{ $professor->getUser->email }}" class="form-control" name="email" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">Parol:</label>
                            <input value="{{ $professor->getUser->password }}" class="form-control" name="password" type="text">
                        </div>
                        <button type="submit" class="btn btn-success">Saqlash</button>
                    </div>

            </form>
        </div>
    </div>
@endsection
