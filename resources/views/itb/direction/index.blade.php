@extends('layouts/admin')

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Yo'nalishlar ro'yhati
                <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal" data-target="#direction_addModal"
                    class="float-right  btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i>
                    QO'SHISH</a>
            </h6>
        </div>

        <div class="card-body">
            @if(!$directions->isEmpty())
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">№</th>
                            <th>Yo'nalishlar nomi:</th>
                            <th width="15%">Umumiy ball</th>
                            <th width="10%">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($directions as $direction)
                            <tr>
                                <td>{{$loop->index+1 }}</td>
                                <td>{{ $direction->name }}</td>
                                <td>{{ $direction->score == null ? 0 : $direction->score }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a data-toggle="modal" data-target="#direction_editModal{{ $direction->id }}"
                                            value="" aria-labelledby="exampleModalLabel"
                                            class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('direction.show', $direction->id) }}"
                                            class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                        <form action="{{ route('direction.destroy', $direction->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" name="status" class="btn btn-danger"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                </td>


                                <!-- Yo'nalish o'zgartirish modal -->
                                <div class="modal fade" id="direction_editModal{{ $direction->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Yo'nalish o'zgartirish</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('direction.update', $direction->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Yo'nalish
                                                            nomi:</label>
                                                        <input type="text" name="name" value="{{$direction->name}}" class="form-control"
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
            </div>
            @else
            <div class="justify-content-center d-flex">
                <h4><span class="badge badge-secondary ">Yo'nalish yo'q</span></h4>
            </div>
            @endif
        </div>



        <!-- Yo'nalish qo`shish modal -->
        <div class="modal fade" id="direction_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yo'nalish qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('direction.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Yo'nalish nomi:</label>
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
