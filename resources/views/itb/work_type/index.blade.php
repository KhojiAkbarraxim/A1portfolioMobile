@extends('layouts/admin')

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Portfolio turlari
                <a href="#" id="type_add" aria-labelledby="headingOne" data-toggle="modal" data-target="#type_addModal"
                    class="float-right  btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i>
                    QO'SHISH</a>
            </h6>
        </div>

        <div class="card-body">
            @if (!$worktype->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">№</th>
                                <th>Miqyosi</th>
                                <th>Portfolio turi</th>
                                <th width="10%">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($worktype as $type)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $type->scale }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a data-toggle="modal" data-target="#type_editModal{{ $type->id }}"
                                                value="" aria-labelledby="exampleModalLabel"
                                                class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-primary rounded mx-2"><i
                                                    class="fa fa-eye"></i></a>
                                            <form action="{{ route('worktype.destroy', $type->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" name="status" class="btn btn-danger"><i
                                                        class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                    </td>


                                    <!-- Work type o'zgartirish modal -->
                                    <div class="modal fade" id="type_editModal{{ $type->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Portfolio turini
                                                        o`zgartirish
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('worktype.update', $type->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Miqyosi:<span style="color:red;">*</span></label>
                                                            <select class="form-control" name="scale_id"
                                                                required="required">
                                                                @foreach ($scale as $miqyos)
                                                                    <option value="{{ $miqyos->id }}">{{ $miqyos->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">
                                                                Portfolio turi
                                                            </label>
                                                            <input type="text" name="name" value="{{ $type->name }}"
                                                                class="form-control">
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
                    <h4><span class="badge badge-secondary ">Portfolio turlari yo'q!</span></h4>
                </div>
            @endif
        </div>



        <!-- Work type qo`shish modal -->
        <div class="modal fade" id="type_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Portfolio turini qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('worktype.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label>Miqyosi:<span style="color:red;">*</span></label>
                                <select class="form-control" name="scale_id" required="required">
                                    @foreach ($scale as $miqyos)
                                        <option value="{{ $miqyos->id }}">{{ $miqyos->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Portfolio turining nomi:</label>
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
