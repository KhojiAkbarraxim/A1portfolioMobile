@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $faculte->name }} - fakultet ma'lumotlari!
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
                                <i class="fa fa-list"></i> <strong>Kafedralar</strong>
                            </button>

                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (!$departments->isEmpty())
                                    <table class="table table-bordered"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%">№</th>
                                                <th width="95%">Kafedra nomi:</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($departments as $department)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $department->name }}</td>
                                                </tr>
                                            @empty
                                                <span class="badge badge-secondary">Kafedra yo'q</span>
                                            @endforelse
                                        </tbody>
                                    </table>
                                @else
                                    <div class="justify-content-center d-flex">
                                        <h4><span class="badge badge-secondary ">Kafedra yo'q</span></h4>
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
                                <i class="fas fa-users"></i> <strong>Guruhlar</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (!$groups->isEmpty())
                                    <table class="table table-bordered"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%">№</th>
                                                <th>Guruhlar nomi:</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($groups as $group)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $group->name }}</td>
                                                </tr>
                                            @empty
                                                <span class="badge badge-secondary">Guruh yo'q</span>
                                            @endforelse
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
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button id="chair" class="btn btn-link collapsed" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="fas fa-award"></i>
                                <strong>Ilmiy rahbarlar</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (!empty($professorsArray))
                                    <table class="table table-bordered"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%">№</th>
                                                <th>Ism familyasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($professorsArray as $professor)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $professor }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="justify-content-center d-flex">
                                        <h4><span class="badge badge-secondary ">Ilmiy rahbar yo'q</span></h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button id="group" class="btn btn-link collapsed" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                <i class="fas fa-user-graduate"></i>
                                <strong>Talabalar</strong>
                            </button>

                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (!empty($studentArray))
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%">№</th>
                                                <th width="55%">Ism familyasi</th>
                                                <th width="10%">Guruhi</th>
                                                <th width="20%" >Telefon raqami</th>
                                                <th width="10%" >Holati</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentArray as $student)
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
    @endsection
