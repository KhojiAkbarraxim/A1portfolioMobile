@extends('layouts.ilmiy', ['title' => 'Barcha portfoliolar'])
@section('content')
@include('itb.alerts.main')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-start">
        <h6 class="m-0 font-weight-bold text-primary">
            Barcha portfoliolar
        </h6>
        {{-- <h6 class="m-0 font-weight-bold text-primary float-right">
           Umumiy ball: <span style="color: green">{{$totalScore}}</span>
        </h6> --}}

    </div>
    <div class="card-body">
        @if (!$allWorks->isEmpty())
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">№</th>
                            <th>Talaba ism familyasi</th>
                            <th>Ilmiy rahbar</th>
                            <th>Portfolio turi</th>
                            <th>Portfolio mavzusi</th>
                            <th>Portfolio link</th>
                            <th>Holati</th>
                            <th>Ball</th>
                            <th width="20px">Amallar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allWorks as $work)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{$work->student}}</td>
                                <td>{{$work->professor}}</td>
                                <td>{{$work->scale." ".$work->worktype}}</td>
                                <td>{{ $work->subject }}</td>
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

                                        <a data-toggle="modal" data-target="#izohModal{{ $work->id }}"
                                            aria-labelledby="exampleModalLabel" class="btn btn-warning rounded"><i
                                                class="fa fa-edit"></i></a>
                                    </div>
                                </td>




                                <!-- Portfolioni bekor qilish-->
                                <div class="modal fade" id="izohModal{{ $work->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Portfolioga izoh qoldirasizmi?</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('teacher.comment', $work->id)}}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Izoh:</label>
                                                        <textarea class="form-control" id="message-text" name="comment" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Ortga</button>
                                                        <button type="submit" class="btn btn-success">Saqlash</button>
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

