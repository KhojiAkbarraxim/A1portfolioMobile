@extends('layouts/admin')

@section('content')
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tanlovlar
                <a href="{{ route('announcement.create') }}" class="float-right  btn btn-sm btn-primary shadow-sm"><i
                        class="fa fa-plus fa-sm text-white-50"></i>
                    QO'SHISH</a>
            </h6>
        </div>

        <div class="card-body">
            {{-- @if (!$worktype->isEmpty()) --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">№</th>
                            <th width="5%">Rasm</th>
                            <th width="20%">Nomi</th>
                            <th width="20%">Ariza olish muddati</th>
                            <th width="20%">Tanlov sanasi</th>
                            <th width="10%">Arizalar soni</th>
                            <th width="10%">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img width="50px" src="{{ '/storage/' . $announcement->thumb_image }}" alt="">
                                </td>
                                <td>{{ $announcement->name }}</td>
                                <td>{!! date('d/m/Y', strtotime($announcement->app_begin)) .
                                    ' dan<br>' .
                                    date('d/m/Y', strtotime($announcement->app_deadline)) .
                                    ' gacha' !!}</td>
                                <td>{!! date('d/m/Y', strtotime($announcement->selection_begin)) .
                                    ' dan<br>' .
                                    date('d/m/Y', strtotime($announcement->selection_date)) .
                                    ' gacha' !!}</td>
                                <td>{{ $announcement->applicationCount }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('announcement.edit', $announcement->id) }}"
                                            class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('announcement.show', $announcement->id) }}"
                                            class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                        <a data-toggle="modal" data-target="#delete{{ $announcement->id }}" value=""
                                            aria-labelledby="exampleModalLabel" class="btn btn-danger rounded">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>


                                <!-- Work type o'zgartirish modal -->
                                <div class="modal fade" id="delete{{ $announcement->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tanlovni o'chirmoqchimisiz?
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('announcement.destroy', $announcement->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-secondary mr-2"
                                                        data-dismiss="modal">Bekor</button>
                                                        <button type="submit" class="btn btn-danger">Ha</button>
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
        </div>

@endsection
