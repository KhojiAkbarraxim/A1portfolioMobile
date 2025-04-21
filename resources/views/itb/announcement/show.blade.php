@extends('layouts.admin')
@section('content')
    <a href="{{ route('announcement.index') }}" class=" btn btn-sm btn-outline-danger shadow-sm   mb-2">
        <i class="fas fa-long-arrow-alt-left"></i> Orqaga</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <span>
                <h6 class="m-0 font-weight-bold text-primary">
                    Tanlov - ma'lumotlari!
                </h6>

            </span>
            <div>
                <a href="#" id="" aria-labelledby="headingOne" data-toggle="modal" data-target="#mezon_add"
                    class=" btn btn-sm btn-primary mr-2 shadow-sm">
                    <i class="fa fa-plus fa-sm"></i> Baholash mezoni</a>
                <a href="#" id="" aria-labelledby="headingOne" data-toggle="modal"
                    data-target="#commissions_add" class=" btn btn-sm btn-primary mr-2 shadow-sm">
                    <i class="fa fa-plus fa-sm"></i> Komissiya a'zosini qo'shish</a>
                <a href="{{ route('announcement.edit', $tanlov->id) }}" class="  btn btn-sm btn-success shadow-sm">
                    Tahrirlash</a>
            </div>
        </div>
        <div class="card-body">
            <div>
                @include('itb.alerts.main')
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-4 d-flex justify-content-center">

                        <img class="rounded mx-auto d-block w-50" src="{{ '/storage/' . $tanlov->image }}" alt="">
                    </div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td class="font-weight-bold">Tanlov nomi</td>
                            <td>{{ $tanlov->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Ariza qabul qilish sanasi</td>
                            <td>{{ $tanlov->app_begin->format('d/m/Y') . ' - ' . $tanlov->app_deadline->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Tanlov o'tkaziladigan sana</td>
                            <td>{{ $tanlov->selection_begin->format('d/m/Y') . ' - ' . $tanlov->selection_date->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Umumiy ma'lumot</td>
                            <td>{!! $tanlov->description !!}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Kommissiya a'zolari</td>
                            <td>
                                @if (!$commissions->isEmpty())
                                    @foreach ($commissions as $commission)
                                        {!! $commission->name . ' ' . $commission->phone . '<br>' !!}
                                    @endforeach
                                @else
                                    <p class="text-warning">Komissiya a'zolari yo'q</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Baholash mezonlari</td>
                            <td>
                                @if (!$criteries->isEmpty())
                                    @foreach ($criteries as $criteria)
                                        {!! $criteria->name . ' - ' . $criteria->ball . ' ball<br>' !!}
                                    @endforeach
                                @else
                                    <p class="text-warning">Baholash mezonlari kiritilmagan</p>
                                @endif
                            </td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <span>
                <h6 class="m-0 font-weight-bold text-primary">
                    Tanlovga jo'natilgan arizalar
                </h6>
            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" id="applicationsWrapper">
                    @if (count($applications) === 0)
                        <h3 class="text-center text-danger">Arizalar mavjud emas!</h3>
                    @else
                        <table class="table table-bordered table-striped" id="applications">
                            <thead>
                                <th width="5%">#</th>
                                <th width="20%">F.I.O</th>
                                <th width="15%">Universitet</th>
                                <th width="5%">Kurs</th>
                                <th width="15%">Telefon raqami</th>
                                <th width="20%">Yo'nalishi</th>
                                <th width="20%">Guruhi</th>
                            </thead>
                            <tbody class="mb-4">

                                @foreach ($applications as $application)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $application->fio }}</td>
                                        <td>{{ $application->university }}</td>
                                        <td>{{ $application->grade }}</td>
                                        <td>{{ $application->phone }}</td>
                                        <td>{{ $application->direction }}</td>
                                        <td>{{ $application->group_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Komissiya a'zosini qo`shish modal -->
    <div class="modal fade" id="commissions_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Komissiya a'zosini qo'shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('commissions.store') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="id" value="{{ $tanlov->id }}">
                        <div class="form-group">
                            <label for="name" class="col-form-label">F.I.O:</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Telefon raqami: <span
                                    class="text-danger small">Telegram ochilgan bo'lishi kerak</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">+998</span>
                                </div>
                                <input type="number" class="form-control" placeholder="901234567" name="phone"
                                    aria-describedby="basic-addon1">
                            </div>
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
    <!-- Baholash mezoni qo`shish modal -->
    <div class="modal fade" id="mezon_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Loyihani baholash mezonlari:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('criteria.add') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="id" value="{{ $tanlov->id }}">
                        <div class="wrapper">
                            <div class="row mb-2" id="mezonRow">
                                <div class="col-lg-8 col-md-6 col-sm-6">
                                    <label for="mezon"> <b> Mezon nomi: </b></label>
                                    <input type="text" class="form-control" name="mezon[]" id="mezon"
                                        value="" required>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="ball"><b>Ball:</b></label>
                                            <input type="number" class="form-control" name="ball[]" id="ball"
                                                value="" required>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="mb-2">
                            <button type="button" onclick="addMezon()" class="btn-sm btn-primary">Mezon
                                qo'shish</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor</button>
                            <button type="submit" class="btn btn-success">Saqlash</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Mezon qo'shish scriptlari --}}
    <script>
        let i = 1;

        function addMezon() {
            i++;
            const mezonRow =
                `<div class="row mb-2" id="mezonRow${i}"\>
                                    <div class="col-lg-8 col-md-6 col-sm-6"\> <label for="mezon${i}"\> <b> Mezon nomi:
                                            </b></label\>
                                        <input type="text" class="form-control" name="mezon[]" id="mezon${i}"
                                            value="" required\>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6"\>
                                        <div class="row"\>
                                            <div class="col-md-8">
                                                <label for="miqdor"\><b>Ball:</b></label\>
                                                <input type="number" class="form-control" name="ball[]" id="miqdor"
                                                    value="" required\>
                                            </div\>
                                            <div class="col-md-4 d-flex align-items-end p-0"\>
                                                <a type="button" class="btn btn-danger mr-2" onclick="deleteRow(${i})"><i
                                                        class="fa fa-trash"></i></a>
                                            </div\>
                                        </div\>

                                    </div\>
                                </div\>`;

            $('.wrapper').append(mezonRow);
        }

        function deleteRow(id) {
            document.getElementById("mezonRow" + id).remove();
        }
    </script>
@endsection
