@extends('layouts/admin')

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ballar ro'yhati
                <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal" data-target="#score_addModal"
                    class="float-right  btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i>
                    QO'SHISH</a>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                @if (!$scores->isEmpty())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">№</th>
                                <th>Portfolio turi</th>
                                <th width="5%">Qo'yiladigan ball</th>
                                <th width="10%">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scores as $score)

                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$score->scale." ".$score->worktype}}</td>
                                        <td>{{ $score->ball }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a data-toggle="modal" data-target="#score_editModal{{ $score->id }}"
                                                    value="" aria-labelledby="exampleModalLabel"
                                                    class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-primary rounded mx-2"><i
                                                        class="fa fa-eye"></i></a>
                                                <form action="{{route('score.destroy', $score->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" name="status" class="btn btn-danger"><i
                                                            class="fa fa-times"></i></button>
                                                </form>
                                            </div>
                                        </td>


                                        <!-- Score o'zgartirish modal -->
                                        <div class="modal fade" id="score_editModal{{ $score->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ball qo'yish</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('score.update', $score->id)}}" method="POST" enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <label>Portfolio turi:<span style="color:red;">*</span></label>
                                                            <select class="form-control" name="type_id" required="required">

                                                                    <option value="{{ $score->type_id }}">
                                                                        {{ $score->scale . ' ' . $score->worktype }}
                                                                    </option>

                                                            </select>

                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">
                                                                    Qo'yiladigan ball
                                                                </label>
                                                                <input type="number" name="ball"
                                                                    value="{{ $score->ball }}" class="form-control"
                                                                    id="recipient-name">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Bekor</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Saqlash</button>
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
                        <h4><span class="badge badge-secondary ">Ball kiritilmagan!</span></h4>
                    </div>
                @endif

            </div>
        </div>



        <!-- Ball qo`shish modal -->
        <div class="modal fade" id="score_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ball qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <label>Portfolio turi:<span style="color:red;">*</span></label>
                            <select class="form-control" name="type_id" required="required">
                                @foreach ($workType as $type)
                                    <option value="{{ $type->id }}">{{ $type->getScale->name . ' ' . $type->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Qo'yiladigan ball:</label>
                                <input type="number" name="ball" class="form-control" id="recipient-name">
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
