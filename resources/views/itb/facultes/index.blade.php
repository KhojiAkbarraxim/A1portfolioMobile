@extends('layouts/admin')

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Fakultetlar ro'yhati
                <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal"
                    data-target="#faculte_addModal" class="float-right  btn btn-sm btn-primary shadow-sm"><i
                        class="fa fa-plus fa-sm text-white-50"></i> QO'SHISH</a>
            </h6>
        </div>
        <div class="card-body">
            @if (!$facultes->isEmpty())


            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">№</th>
                            <th>Fakultetlar nomi:</th>
                            <th width="10%">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facultes as $faculte)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $faculte->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a data-toggle="modal" data-target="#faculte_editModal{{ $faculte->id }}" value=""
                                            aria-labelledby="exampleModalLabel" class="btn btn-warning rounded"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="{{ route('faculte.show', $faculte->id) }}"
                                            class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                        <form action="{{ route('faculte.destroy', $faculte->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" name="status" class="btn btn-danger"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                </td>


                                <!-- Fakultet o'zgartirish -->
                                <div class="modal fade" id="faculte_editModal{{ $faculte->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Fakultet o'zgartirish</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('faculte.update', $faculte->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" value="{{ $faculte->id }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Fakultet
                                                            nomi:</label>
                                                        <input type="text" name="name" value="{{ $faculte->name }}"
                                                            class="form-control" id="recipient-name">
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
                        <h4><span class="badge badge-secondary ">Fakultet yo'q</span></h4>
                    </div>
            @endif
        </div>
        @include('itb.facultes.modals')
    @endsection
