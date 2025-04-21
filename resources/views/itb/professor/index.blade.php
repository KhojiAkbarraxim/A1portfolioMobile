@extends('layouts/admin')

@section('content')
    <style>
        .eyeInput {
            position: relative;
        }

        .eyeIcon {
            position: absolute;
            top: 50px;
            right: 10px;
            cursor: pointer;
        }
    </style>
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ilmiy rahbarlar
                <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal"
                    data-target="#teacher_addModal" class="float-right  btn btn-sm btn-primary shadow-sm"><i
                        class="fa fa-plus fa-sm text-white-50"></i>
                    QO'SHISH</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="center">
                            <th width="5%">№</th>
                            <th> Ism familyasi</th>
                            <th>Kafedrasi</th>
                            <th>Holat</th>
                            <th width="10%">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($professors as $professor)
                            <tr>
                                <td>{{ $loop->index+1}}</td>
                                <td>{{ $professor->getUser->name }}</td>
                                <td>{{ $professor->getDepartment->name }}</td>
                                <td>
                                    @if ($professor->status == 1)
                                        Faol
                                    @else
                                        Bloklangan
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('professor.edit', $professor->id) }}"
                                            class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('professor.show', $professor->id)}}" class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                        <form action="{{ route('professor.destroy', $professor->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" name="status"
                                                class="btn btn-{{ $professor->status == true ? 'danger' : 'success' }}"><i
                                                    class="fa fa-{{ $professor->status == true ? 'times' : 'check' }}"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Ilmiy rahbar qo`shish modal -->
        <div class="modal fade" id="teacher_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ilmiy rahbar qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('professor.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <label>Kafedra:<span style="color:red;">*</span></label>
                            <select class="form-control" name="department_id" required="required">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">O'qituvchi ism familyasi:</label>
                                <input type="text" name="name" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email(login):</label>
                                <input type="email" name="email" class="form-control" id="">
                            </div>
                            <div class="form-group eyeInput">
                                <label for="recipient-name" class="col-form-label">Parol:</label>
                                <input type="password" name="password" class="form-control" id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill eyeIcon d-none" onclick="showHidePassword()" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-slash-fill eyeIcon" onclick="showHidePassword()" viewBox="0 0 16 16">
                                    <path
                                        d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                </svg>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor</button>
                                <button type="submit" class="btn btn-primary">Saqlash</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script>
            function showHidePassword() {
                if ($('input[name="password"]')[0].getAttribute('type') == 'password') {
                    $('.bi-eye-fill')[0].classList.remove('d-none');
                    $('.bi-eye-slash-fill')[0].classList.add('d-none');
                    $('input[name="password"]')[0].setAttribute('type', 'text');
                } else {
                    $('.bi-eye-fill')[0].classList.add('d-none');
                    $('.bi-eye-slash-fill')[0].classList.remove('d-none');
                    $('input[name="password"]')[0].setAttribute('type', 'password');
                }
            }
        </script>
    @endsection
