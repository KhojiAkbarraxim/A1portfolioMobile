@extends('layouts.admin')
@section('content')
    @include('itb.alerts.main')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Portfoliolarga yozilgan izohlar
            </h6>

        </div>
        <div class="card-body">
            @if (!$comments->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">№</th>
                                <th width="30%">Izoh yozgan rahbar</th>
                                <th width="25%">Talaba</th>
                                <th width="5%">Portfolio link</th>
                                <th width="5%">Ball</th>
                                <th width="10%">Izoh</th>
                                <th width="10%">Javob</th>
                                <th width="10%">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comments->currentPage() * $comments->PerPage() + $loop->iteration - $comments->PerPage() }}
                                    </td>
                                    <td>{{ $comment->teacher }}</td>
                                    <td>{{ $comment->student }}</td>
                                    <td><a href="{{ $comment->work }}" target="_blank" class="">Link<span
                                                class="fas fa-link"></span></a></td>
                                    <td>{{ $comment->ball }}</td>
                                    {{-- <td>{{ Str::length($comment->message) <=6 ? $comment->message : <a href="#" target="_blank" class="">Link<span
                                        class="fas fa-link"></span></a> }}</td> --}}
                                    @if (Str::length($comment->message) <= 10)
                                        <td>{{ $comment->message }}</td>
                                    @else
                                        <td><a href="#" data-toggle="modal"
                                                data-target="#contentModal{{ $comment->id }}"
                                                aria-labelledby="exampleModalLabel">{{ Str::substr($comment->message, 0, 6) }}...</a>
                                        </td>
                                    @endif
                                    @if (!empty($comment->answer))
                                    {{-- @if (Str::length($comment->answer) <= 10) --}}
                                        <td>{!! Str::length($comment->answer) <= 10 ? $comment->answer : '<a href="#" data-toggle="modal"
                                            data-target="#answerModal' . $comment->id .'"
                                            aria-labelledby="exampleModalLabel">' . Str::substr($comment->answer, 0, 6) . '...</a>
                                    ' !!}</td>
                                    @else
                                        <td><span style="color: darkgreen"> Javob berilmagan</span></td>
                                    @endif
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a data-toggle="modal" data-target="#replyModal{{ $comment->id }}"
                                                aria-labelledby="exampleModalLabel" class="btn btn-success rounded mr-2"><i
                                                    class="fa fa-reply"></i></a>

                                            <a data-toggle="modal" data-target="#cancelModal{{ $comment->id }}"
                                                aria-labelledby="exampleModalLabel" class="btn btn-danger rounded "><i
                                                    class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                     <!-- Javob berish-->
                                    <div class="modal fade" id="replyModal{{ $comment->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Izohga javob <i
                                                            class="fas fa-reply"></i></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('comment.reply', $comment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="message-text" name="reply" required></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Ortga</button>
                                                            <button type="submit" class="btn btn-success">Yuborish</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bekor qilish -->
                                    <div class="modal fade" id="cancelModal{{ $comment->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Izohni bekor qilish sababi <i
                                                            class="fas fa-reply"></i></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('comment.cancel', $comment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="message-text" name="reply" required></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Ortga</button>
                                                            <button type="submit" class="btn btn-success">Yuborish</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Izohni ko'rish modal -->
                                    <div class="modal fade" id="contentModal{{ $comment->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <span style="color:cornflowerblue">Izoh matni:</span>
                                                    {{ $comment->message }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Ortga</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Javobni ko'rish modal -->
                                    <div class="modal fade" id="answerModal{{ $comment->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <span style="color:cornflowerblue">Javob matni:</span>
                                                    {{ $comment->answer }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Ortga</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $comments->links('pagination::bootstrap-4') }}

                </div>
            @else
                <div class="justify-content-center d-flex">
                    <h4><span class="badge badge-secondary ">Izohlar yo'q</span></h4>
                </div>
            @endif
        </div>
    @endsection
