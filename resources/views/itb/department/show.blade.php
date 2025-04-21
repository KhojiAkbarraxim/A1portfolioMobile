@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $department->name }} - kafedrasi.
            </h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (!$professors->isEmpty())
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="center">
                            <th width="5%">№</th>
                            <th>Kafedradagi ilmiy rahbarlar</th>
                            <th width="15%">Holat</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($professors as $professor)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $professor->name }}</td>
                                <td>
                                    @if ($professor->status==1)
                                    Faol
                                    @else
                                    Bloklangan
                                @endif
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
    @endsection
