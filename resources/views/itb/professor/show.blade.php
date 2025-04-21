@extends('layouts/admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $professor->getUser->name }} - ma'lumotlari!
            </h6>
            <a href="#" id="attach" aria-labelledby="headingOne" data-toggle="modal" data-target="#attachModal"
                class="float-right  btn btn-sm btn-primary shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i>
                Talaba biriktirish</a>
        </div>
        <div class="card-body">
            <div>
                @include('itb.alerts.main')
            </div>

            <div class="row">
                <div class="col-md-3">
                    @if (!empty($professor))
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td class="font-weight-bold">Ism familyasi</td>
                                <td>{{ $professor->getUser->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Kafedrasi</td>
                                <td>{{ $professor->getDepartment->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Login</td>
                                <td>{{ $professor->getUser->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Parol</td>
                                <td>{{ $professor->getUser->password}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Holat</td>
                                <td>    
                                    @if ($professor->status == 1)
                                        Faol
                                    @else
                                        Bloklangan
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="table-responsive">
                        @if (!empty($studentsArray))
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-primary text-light">
                                    <tr class="center">
                                        <th width="5%">№</th>
                                        <th> Ism familyasi</th>
                                        <th>Guruhi</th>
                                        <th>Telefon raqami</th>
                                        <th>Holat</th>
                                        <th width="10%">Amallar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentsArray as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->group }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>
                                                @if ($student->status == 1)
                                                    Faol
                                                @else
                                                    Bloklangan
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('student.edit', $student->id) }}"
                                                        class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ route('student.show', $student->id) }}"
                                                        class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                                                    <form action="#" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" name="status"
                                                            class="btn btn-{{ $student->status == true ? 'danger' : 'success' }}"><i
                                                                class="fa fa-{{ $student->status == true ? 'times' : 'check' }}"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="justify-content-center d-flex">
                                <h4><span class="badge badge-secondary ">Biriktirilgan talaba yo'q</span></h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <!-- Talaba biriktirish modal -->
        <div class="modal fade" id="attachModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $professor->name }}ga talabani biriktirish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('attach_student', $professor->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{-- <input type="hidden" name="professor_id" value="{{$professor->id}}"> --}}
                            @method('POST')
                            @csrf

                            <label>Talaba:<span style="color:red;">*</span></label>
                            <select class="form-control" name="student_id" required="required">
                                <option value="">Tanlang</option>
                                @foreach ($students as $talaba)
                                    <option value="{{ $talaba->id }}">
                                        {{ $talaba->name . ' ' . $talaba->getGroup->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor</button>
                                <button type="submit" class="btn btn-primary">Saqlash</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.querySelector('#student').addEventListener('click', () => {
                document.querySelector('#attach').classList.toggle('d-none');
            });
        </script>
    @endsection
