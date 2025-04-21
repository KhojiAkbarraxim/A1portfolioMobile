@extends('layouts/admin')

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Guruhlar ro'yhati
                <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal" data-target="#group_addModal"
                    class="float-right  btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i>
                    QO'SHISH</a>
            </h6>
        </div>

        <div class="card-body">
            @if (!$groups->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">№</th>
                                <th width="85%">Guruhlar nomi:</th>
                                <th width="10%">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a data-toggle="modal" data-target="#group_editModal{{ $group->id }}"
                                                value="" aria-labelledby="exampleModalLabel"
                                                class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('group.show', $group->id) }}"
                                                class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                            <form action="{{ route('group.destroy', $group->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" name="status" class="btn btn-danger"><i
                                                        class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                    </td>


                                    <!-- Guruh o'zgartirish modal -->
                                    <div class="modal fade" id="group_editModal{{ $group->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Guruh qo'shish</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('group.update', $group->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @method('POST')
                                                        @csrf
                                                        <label>Fakultet:<span style="color:red;">*</span></label>
                                                        <select class="form-control" name="faculte_id" required="required">
                                                            @foreach ($facultes as $faculte)
                                                                <option value="{{ $faculte->id }}">{{ $faculte->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label>Yo'nalish:<span style="color:red;">*</span></label>
                                                        <select class="form-control" name="direction_id"
                                                            required="required">
                                                            @foreach ($directions as $direction)
                                                                <option value="{{ $direction->id }}">{{ $direction->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Guruh
                                                                nomi:</label>
                                                            <input type="text" name="name"
                                                                value="{{ $group->name }}" class="form-control"
                                                                id="recipient-name">
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
                @else
                    <div class="justify-content-center d-flex">
                        <h4><span class="badge badge-secondary ">Guruhlar yo'q</span></h4>
                    </div>
                </div>
            @endif





        <!-- Guruh qo`shish modal -->
        <div class="modal fade" id="group_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Guruh qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('group.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <label>Fakultet:<span style="color:red;">*</span></label>
                            <select class="form-control" name="faculte_id" required="required">
                                @foreach ($facultes as $faculte)
                                    <option value="{{ $faculte->id }}">{{ $faculte->name }}</option>
                                @endforeach
                            </select>
                            <label>Yo'nalish:<span style="color:red;">*</span></label>
                            <select class="form-control" name="direction_id" required="required">
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Guruh nomi:</label>
                                <input type="text" name="name" class="form-control" id="recipient-name">
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
