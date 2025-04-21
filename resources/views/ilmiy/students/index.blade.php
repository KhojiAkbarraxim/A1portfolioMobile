@extends('layouts.ilmiy', ['title' => 'Biriktirilgan talabalarim'])
@section('content')
@include('itb.alerts.main')
<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Talabalar

        </h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            @if (!empty($studentsArray))
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="center">
                        <th width="5%">№</th>
                        <th>Ism familyasi</th>
                        <th>Guruh</th>
                        <th>Telefon raqami</th>
                        <th>Holat</th>
                        <th width="20px">Amallar</th>
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
                            <td>
                                    <a href="{{route('show.student', $student->id)}}" class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="justify-content-center d-flex">
                <h4><span class="badge badge-secondary ">Sizga talaba biriktirilmagan!</span></h4>
            </div>
            @endif

        </div>
    </div>
@endsection
