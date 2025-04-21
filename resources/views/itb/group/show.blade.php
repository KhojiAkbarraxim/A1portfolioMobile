@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $group->name }} guruhi
            </h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (!$students->isEmpty())
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">№</th>
                            <th>Talabaning ism familyasi</th>
                            <th>Guruhi</th>
                            <th>Telefon raqami</th>
                            <th>Holati</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
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
                @endif
                @if ($students->isEmpty())
                    <div class="justify-content-center d-flex">
                        <h4><span class="badge badge-secondary ">Talaba yo'q</span></h4>
                    </div>
                @endif
            </div>

        </div>
    @endsection
