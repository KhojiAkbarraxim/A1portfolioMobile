@extends('layouts/admin')

@section('content')
<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
           {{$department->name}} - tahrirlash
        </h6>
    </div>
    <div class="card-body">
        @include('itb.alerts.main')
        <form method="POST" enctype="multipart/form-data" action="{{route('department.update', $department->id)}}">
            @csrf
            @method('PUT')

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-group">
                        <label>Fakultet:<span style="color:red;">*</span></label>
                                <select class="form-control" name="faculte_id" required="required">
                                    @foreach ($facultes as $faculte)
                                    <option value="{{$faculte->id}}">{{$faculte->name}}</option>
                                    @endforeach
                                </select>
                        <label for="">Kafedra nomi</label>
                        <input value="{{$department->name}}" class="form-control" name="name" type="text">
                    </div>


                </div>
            <button type="submit" class="btn btn-success">Saqlash</button>

        </form>
    </div>
</div>

@endsection
