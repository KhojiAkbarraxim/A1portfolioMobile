@extends('layouts/student', ['title' => 'Talaba ishlari'])

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Mening ishlarim

            </h6>
            <div class="d-flex align-items-center">
                <span class="font-weight-bold text-info mr-4">Jami ball:
                    {{ $totalScore }}</span>
                <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal" data-target="#work_addModal"
                class="float-right  btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i>
                QO'SHISH</a>

            </div>

        </div>

        <div class="card-body">
            @if (!$works->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">№</th>
                                <th>Portfolio mavzusi</th>
                                <th>Portfolio turi</th>
                                <th>Portfolio link</th>
                                <th>Holati</th>
                                <th>Ball</th>
                                <th width="10%">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($works as $work)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $work->subject }}</td>
                                    <td>{{ $work->scale. ' ' . $work->type }}</td>
                                    <td><a href="{{ $work->link }}" target="_blank" class="">Link<span
                                                class="fas fa-link"></span></a></td>
                                    @if ($work->status == 0)
                                        <td><span style="color:darkorange"> Tekshirilmagan</span></td>
                                    @elseif ($work->status == 1)
                                        <td><span style="color: green"> Tasdiqlangan</span></td>
                                    @else
                                        <td><span style="color: red"> Bekor qilindi!</span></td>
                                    @endif
                                    <td>{{ $work->score }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a data-toggle="modal" data-target="#work_editModal{{ $work->id }}"
                                                value="" aria-labelledby="exampleModalLabel"
                                                class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                            <a href="{{ $work->link }}" target="_blank"
                                                class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                            <a data-toggle="modal" data-target="#deleteModal"
                                                aria-labelledby="exampleModalLabel" class="btn btn-danger rounded"><i
                                                    class="fa fa-times"></i></a>
                                        </div>
                                    </td>


                                    <!-- Portfolio o'zgartirish modal -->
                                    <div class="modal fade" id="work_editModal{{ $work->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Portfolio o'zgartirish
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('work.update', $work->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Portfolio turi:<span style="color:red;">*</span></label>
                                                            <select class="form-control" name="type_id" required="required">
                                                                <option>tanlang</option>
                                                                @foreach ($work_type as $type)
                                                                    <option value="{{ $type->id }}">
                                                                        {{ $type->getScale->name . ' ' . $type->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <label for="subject">Mavzu:<span
                                                                    style="color:red;">*</span></label>
                                                            <input type="text" name="subject"
                                                                value="{{ $work->subject }}" class="form-control"
                                                                id="subject">

                                                            <label for="link" class="col-form-label">Link:</label>
                                                            <input type="text" name="link"
                                                                value="{{ $work->link }}" class="form-control"
                                                                id="link">
                                                            <label for="date" class="col-form-label">Olingan
                                                                vaqt:</label>
                                                            <input type="date" name="date" id="date"
                                                                class="form-control" value="{{ $work->date }}">
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

                                    <!-- Portfolio o'chirish-->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Portfolioni
                                                        o'chirmoqchimisiz?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('work.destroy', $work->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Bekor</button>
                                                        <button type="submit" class="btn btn-primary">Ha</button>
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
                    <h4><span class="badge badge-secondary ">Sizda portfolio yo'q</span></h4>
                </div>
            @endif
        </div>



        <!-- Portfolio qo`shish modal -->
        <div class="modal fade" id="work_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Portfolio qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('work.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label>Portfolio turi:<span style="color:red;">*</span></label>
                                <select class="form-control" name="type_id" required="required">
                                    <option>tanlang</option>
                                    @foreach ($work_type as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->getScale->name . ' ' . $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="subject">Mavzu:<span style="color:red;">*</span></label>
                                <input type="text" name="subject" class="form-control" id="subject">

                                <label for="link" class="col-form-label">Link:</label>
                                <input type="text" name="link" value="http://" class="form-control"
                                    id="link">
                                <label for="date" class="col-form-label">Olingan vaqt:</label>
                                <input type="date" name="date" id="date" class="form-control">
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
