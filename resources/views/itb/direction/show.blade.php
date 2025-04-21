@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $direct->name }} - yo'nalish ma'lumotlari!
            </h6>

        </div>
        <div class="card-body">
            <div>
                @include('itb.alerts.main')
            </div>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button id="faculte" class="btn btn-link collapsed" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <i class="fa fa-list"></i> <strong>Guruhlar</strong>
                            </button>

                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (!$groups->isEmpty())
                                    <table class="table table-bordered"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%">№</th>
                                                <th width="95%">Guruh nomi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($groups as $group)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $group->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="justify-content-center d-flex">
                                        <h4><span class="badge badge-secondary ">Guruh yo'q</span></h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button id="direction" class="btn btn-link collapsed" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="fas fa-users"></i> <strong>Talabalar</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (!empty($studentsArray))
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">№</th>
                                                <th width="40%">Ism familyasi</th>
                                                <th width="20%">Guruhi</th>
                                                <th width="28%">Telefon raqami</th>
                                                <th width="10%">Holati</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentsArray as $student)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->getGroup->name }}</td>
                                                    <td>{{ $student->phone }}</td>
                                                    <td>
                                                        @if ($student->status == 1)
                                                            Faol
                                                        @else
                                                            Bloklangan
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="justify-content-center d-flex">
                                        <h4><span class="badge badge-secondary ">Talaba yo'q</span></h4>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Yo'nalish haqida
            </h6>

        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td class="font-weight-bold">Yo'nalish nomi:</td>
                    <td>{{ $direct->name }}</td>
                </tr>

                <tr>

                    <td class="font-weight-bold">Guruhlar:</td>
                    <td>
                        @forelse ($groups as $group)
                            {{ $group->name }}
                            <br>
                        @empty
                        <span class="badge badge-secondary">Guruhlar yo'q</span>
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Talabalar:</td>
                    <td>
                        @forelse ($studentsArray as $student)
                        {{$student->name}}
                        <br>
                        @empty
                        <span class="badge badge-secondary">Talaba yo'q!</span>
                        @endforelse
                    </td>
                </tr>
            </table>
        </div> --}}
    @endsection
