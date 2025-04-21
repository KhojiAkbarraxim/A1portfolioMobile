@extends('layouts.ilmiy', ['title' => 'Portfolioni ko\'rish'])
@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $student->name }}ning portfoliosi </h6>
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
                                    <td>{{ $work->getWorkType->getScale->name . ' ' . $work->getWorkType->name }}</td>
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
                                            <a data-toggle="modal" data-target="#successModal{{$work->id}}"
                                                aria-labelledby="exampleModalLabel" class="btn btn-success rounded"><i
                                                    class="fa fa-check"></i></a>
                                            <a href="{{ $work->link }}" target="_blank"
                                                class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                            <a data-toggle="modal" data-target="#bekorModal{{$work->id}}"
                                                aria-labelledby="exampleModalLabel" class="btn btn-danger rounded "><i
                                                    class="fa fa-times"></i></a>
                                        </div>
                                    </td>


                                    <!-- Portfolioni tasdiqlash Modal-->
                                    <div class="modal fade" id="successModal{{$work->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Portfolioni tasdiqlaysizmi?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-footer">
                                                    <form method="POST" action="{{route('success.work', $work->id)}}">
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Yo'q</button>
                                                        <button type="submit" class="btn btn-success">Ha</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Portfolioni bekor qilish-->
                                    <div class="modal fade" id="bekorModal{{$work->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Portfolioni bekor
                                                        qilmoqchimisiz?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('cancel.work', $work->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Izoh:</label>
                                                            <textarea class="form-control" id="message-text" name="desc" required></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Ortga</button>
                                                            <button type="submit" class="btn btn-danger">Bekor
                                                                qilish</button>
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
                    <h4><span class="badge badge-secondary ">Portfolio yo'q</span></h4>
                </div>
            @endif
        </div>

    @endsection
