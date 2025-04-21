@extends('layouts/admin')

@section('content')
    <style>
        .eyeInput {
            position: relative;
        }

        .eyeIcon {
            position: absolute;
            top: 50px;
            right: 10px;
            cursor: pointer;
        }
    </style>
    @include('itb.alerts.main')
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 ">
            <div class="row d-flex justify-content-between">
                <span>
                    <h6 class="m-0 font-weight-bold text-primary">Talabalar</h6>
                    <small class="text-secondary font-italic">Umumiy talabalar soni: {{ count($students) }}</small>
                </span>

                <div class="col-md-2">
                    <select class="form-control filter" id="fakultetSelect" onchange="sendAJAXByFaculty(this.value)">
                        <option selected disabled> Fakultetlar</option>
                        @foreach ($facultes as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                </select>
                </div>

                <div class="col-md-2">
                    {{-- <i class="fas fa-filter"></i> --}}
                    <select class="form-control" id="kafedraSelect" onchange="sendAjaxByDepartment(this.value)">
                        <option selected disabled> Kafedralar</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" id="directionSelect" onchange="sendAjaxByDirection(this.value)">
                        <option selected disabled>Yo'nalishlar</option>
                        @foreach ($directions as $direction)
                            <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" id="groupSelect" onchange="sendAjaxByGroup(this.value)">
                        <option selected disabled>Guruhlar</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <a href="#" id="faculte_add" aria-labelledby="headingOne" data-toggle="modal"
                        data-target="#student_addModal" class="float-right  btn btn-sm btn-primary shadow-sm"><i
                            class="fa fa-plus fa-sm text-white-50"></i>
                        QO'SHISH</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                @if (!$students->isEmpty())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="center">
                                <th width="5%">№</th>
                                <th width="30%">Ism familyasi</th>
                                <th width="10%">Guruh</th>
                                <th width="15%">Umumiy ball</th>
                                <th width="15%">Telefon raqami</th>
                                <th width="15%">Holat</th>
                                <th width="10%">Amallar</th>
                            </tr>
                        </thead>
                        <tbody id="studentsDataTableBody">
                            {{-- @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->getGroup->name }}</td>
                                    <td>{{ $student->totalScore == null ? 0 : $student->totalScore }}</td>
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
                                            <form action="{{ route('student.destroy', $student->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" name="status"
                                                    class="btn btn-{{ $student->status == true ? 'danger' : 'success' }}"><i
                                                        class="fa fa-{{ $student->status == true ? 'times' : 'check' }}"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                @else
                    <div class="justify-content-center d-flex">
                        <h4><span class="badge badge-secondary ">Talaba yo'q</span></h4>
                    </div>
                @endif

            </div>
        </div>




        <!-- Talaba qo`shish modal -->
        <div class="modal fade" id="student_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Talaba qo'shish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success contact-success" style="display: none;"></div>
                        <div class="alert alert-danger contact-error" style="display: none;"></div>
                        <form id="student_add" action="{{ route('student.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <label>Guruh:<span style="color:red;">*</span></label>
                            <select class="form-control" name="group_id" required="required">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Ism familyasi:</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Telefon raqami:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+998</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="901234567" name="phone"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email(login):</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group eyeInput">
                                <label class="col-form-label">Parol:</label>
                                <input type="password" name="password" class="form-control">

                                <i class="fa fa-eye eyeIcon" onclick="showHidePassword()"></i>
                                <i class="fa fa-eye-slash eyeIcon" onclick="showHidePassword()"></i>
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

        <script>
            function showHidePassword() {
                if ($('input[name="password"]')[0].getAttribute('type') == 'password') {
                    $('.form-group .fa-eye')[0].classList.remove('d-none');
                    $('.form-group .fa-eye-slash')[0].classList.add('d-none');
                    $('input[name="password"]')[0].setAttribute('type', 'text');
                } else {
                    $('.form-group .fa-eye')[0].classList.add('d-none');
                    $('.form-group .fa-eye-slash')[0].classList.remove('d-none');
                    $('input[name="password"]')[0].setAttribute('type', 'password');
                }
            }
        </script>

       {{-- Fakultet filter --}}
        <script defer>
            function sendAJAXByFaculty(facultyID) {
                const url = '{{ route('student.AJAXRequest') }}';
                console.log(url);
                console.log(facultyID);
                // let facultySelect = document.querySelector('#fakultetSelect')
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        facultyID: facultyID,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function({
                        status,
                        students
                    }) {

                        const dataTableStudents = document.querySelector('#studentsDataTableBody');
                        console.log('Status: ', status);
                        console.log('Students: ', students);
                        let html = '';
                        students.forEach((student, index) => {
                            let editURL = `/itb/student/${student.studentID}/edit`;
                            let showURL = `/itb/student/${student.studentID}`;
                            let deleteURL = `/itb/student/${student.studentID}`;
                            html += '<tr>';
                            html += `

                    <td>${index + 1}</td>
                    <td>${student.name}</td>
                    <td>${student.groupName}</td>
                    <td>${student.totalScore == null ? "0" : student.totalScore}</td>
                    <td>${student.phone}</td>
                    <td>${student.status == 1 ? "Faol" : "Bloklangan"}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="${editURL}"
                                class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                            <a href="${showURL}"
                                class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                            <form action="${deleteURL}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" name="status"
                                    class="btn btn-${student.status == 1 ? "danger" : "success"}"><i
                                        class="fa fa-${student.status == 1 ? "times" : "check"}"></i></button>
                            </form>
                        </div>
                    </td>

                    `;
                            html += '</tr>'
                        })

                        dataTableStudents.innerHTML = html;



                    }
                })

            }
        </script>
        {{-- yo'nalish filter --}}
        <script defer>
            function sendAjaxByDirection(DirectionID) {
                const url = '{{ route('student.ajaxDirection') }}';
                console.log(url);
                console.log(DirectionID);
                // let facultySelect = document.querySelector('#fakultetSelect')
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        DirectionID: DirectionID,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function({
                        status,
                        students
                    }) {

                        const dataTableStudents = document.querySelector('#studentsDataTableBody');
                        console.log('Status: ', status);
                        console.log('Students: ', students);
                        let html = '';
                        students.forEach((student, index) => {
                            let editURL = `/itb/student/${student.studentID}/edit`;
                            let showURL = `/itb/student/${student.studentID}`;
                            let deleteURL = `/itb/student/${student.studentID}`;
                            html += '<tr>';
                            html += `

            <td>${index + 1}</td>
            <td>${student.name}</td>
            <td>${student.groupName}</td>
            <td>${student.totalScore == null ? "0" : student.totalScore}</td>
            <td>${student.phone}</td>
            <td>${student.status == 1 ? "Faol" : "Bloklangan"}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="${editURL}"
                        class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                    <a href="${showURL}"
                        class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                    <form action="${deleteURL}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" name="status"
                            class="btn btn-${student.status == 1 ? "danger" : "success"}"><i
                                class="fa fa-${student.status == 1 ? "times" : "check"}"></i></button>
                    </form>
                </div>
            </td>

            `;
                            html += '</tr>'
                        })

                        dataTableStudents.innerHTML = html;

                    }
                })

            }
        </script>

        {{-- Group ajax request --}}
        <script defer>
            function sendAjaxByGroup(GroupID) {
                const url = '{{ route('student.ajaxGroup') }}';
                console.log(url);
                console.log(GroupID);
                // let facultySelect = document.querySelector('#fakultetSelect')
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        GroupID: GroupID,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function({
                        status,
                        students
                    }) {

                        const dataTableStudents = document.querySelector('#studentsDataTableBody');
                        console.log('Status: ', status);
                        console.log('Students: ', students);
                        let html = '';
                        students.forEach((student, index) => {
                            let editURL = `/itb/student/${student.studentID}/edit`;
                            let showURL = `/itb/student/${student.studentID}`;
                            let deleteURL = `/itb/student/${student.studentID}`;
                            html += '<tr>';
                            html += `

                    <td>${index + 1}</td>
                    <td>${student.name}</td>
                    <td>${student.groupName}</td>
                    <td>${student.totalScore == null ? "0" : student.totalScore}</td>
                    <td>${student.phone}</td>
                    <td>${student.status == 1 ? "Faol" : "Bloklangan"}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="${editURL}"
                                class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                            <a href="${showURL}"
                                class="btn btn-primary rounded mx-2"><i class="fa fa-eye"></i></a>
                            <form action="${deleteURL}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" name="status"
                                    class="btn btn-${student.status == 1 ? "danger" : "success"}"><i
                                        class="fa fa-${student.status == 1 ? "times" : "check"}"></i></button>
                            </form>
                        </div>
                    </td>

                    `;
                            html += '</tr>'
                        })

                        dataTableStudents.innerHTML = html;

                    }
                })

            }
        </script>
    @endsection
