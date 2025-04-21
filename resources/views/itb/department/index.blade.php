@extends('layouts/admin')

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kafedralar ro'yhati
                <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal"
                    data-target="#department_addModal" class="float-right  btn btn-sm btn-primary shadow-sm"><i
                        class="fa fa-plus fa-sm text-white-50"></i> QO'SHISH</a>
            </h6>
        </div>
        <div class="card-body">
            @if(!$departments->isEmpty())
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">№</th>
                            <th width="85%">Kafedralar nomi:</th>
                            <th width="10%">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a data-toggle="modal" data-target="#department_editModal{{ $department->id }}"
                                            value="" aria-labelledby="exampleModalLabel"
                                            class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('department.show', $department->id) }}"
                                            class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                        <form action="{{ route('department.destroy', $department->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" name="status" class="btn btn-danger"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <!-- Kafedra o'zgartirish modali -->
                                <div class="modal fade" id="department_editModal{{ $department->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Kafedrani tahrirlash</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('department.update', $department->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Fakultet:<span style="color:red;">*</span></label>
                                                        <select class="form-control" name="faculte_id" required="required">
                                                            @foreach ($facultes as $faculte)
                                                                <option value="{{ $faculte->id }}">{{ $faculte->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label for="recipient-name" class="col-form-label">Kafedra
                                                            nomi:</label>
                                                        <input type="text" name="name" value="{{ $department->name }}"
                                                            class="form-control" required="required" id="recipient-name">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Bekor</button>
                                                        <button type="submit" class="btn btn-primary">Saqlash</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            @else
            <div class="justify-content-center d-flex">
                <h4><span class="badge badge-secondary ">Kafedra yo'q</span></h4>
            </div>
            @endif
        </div>

        <!-- Kafedra qo'shish modal -->
        <div class="modal fade" id="department_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kafedra qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label>Fakultet:<span style="color:red;">*</span></label>
                                <select class="form-control" name="faculte_id" required="required">
                                    @foreach ($facultes as $faculte)
                                        <option value="{{ $faculte->id }}">{{ $faculte->name }}</option>
                                    @endforeach
                                </select>
                                <label for="recipient-name" class="col-form-label">Kafedra nomi:</label>
                                <input type="text" name="name" class="form-control" required="required"
                                    id="recipient-name">
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
    @endsection
