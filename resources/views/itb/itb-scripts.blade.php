  {{-- <!-- Fakultet qo'shish button -->
  <script>
      document.querySelector('#faculte').addEventListener('click', () => {
          document.querySelector('#faculte_add').classList.toggle('d-none');
      });
  </script>
  <!-- kafedra qo'shish button -->
  <script>
      document.querySelector('#chair').addEventListener('click', () => {
          document.querySelector('#chair_add').classList.toggle('d-none');
      });
  </script>
  <!-- Yo'nalish qo'shish button -->
  <script>
      document.querySelector('#direction').addEventListener('click', () => {
          document.querySelector('#direction_add').classList.toggle('d-none');
      });
  </script>
  <!-- Guruh qo'shish button -->
  <script>
      document.querySelector('#group').addEventListener('click', () => {
          document.querySelector('#group_add').classList.toggle('d-none');
      });
  </script>
  <!-- Ilmiy rahbar qo'shish button -->
  <script>
      document.querySelector('#teacher').addEventListener('click', () => {
          document.querySelector('#teacher_add').classList.toggle('d-none');
      });
  </script>
  <!-- Talaba qo'shish button -->
  <script>
      document.querySelector('#student').addEventListener('click', () => {
          document.querySelector('#student_add').classList.toggle('d-none');
      });
  </script>

  <style>
      .eyeInput {
          position: relative;
      }

      .eyeInputStudent {
          position: relative;
      }

      .eyeIcon {
          position: absolute;
          top: 50px;
          right: 10px;
          cursor: pointer;
      }
  </style>

  <!-- fakultet qo`shish modal -->
  <div class="modal fade" id="faculte_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Fakultet qo'shish</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('facultes.create') }}" method="POST" enctype="multipart/form-data">
                      @method('POST')
                      @csrf
                      <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Fakultet nomi:</label>
                          <input type="text" name="name" class="form-control" id="recipient-name">
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

  <!-- Yo'nalish qo`shish modal -->
  <div class="modal fade" id="direction_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Yo'nalish qo'shish</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('direction.store') }}" method="POST" enctype="multipart/form-data">
                      @method('POST')
                      @csrf
                      <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Yo'nalish nomi:</label>
                          <input type="text" name="name" class="form-control" id="recipient-name">
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

  <div class="modal fade" id="department_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kafedra qo'shish</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
                      @method('POST')
                      @csrf
                      <div class="form-group">
                          <label>Fakultet:<span style="color:red;">*</span></label>
                          <select class="form-control" name="faculte_id" required="required">
                              @foreach ($facultes as $faculte)
                                  <option value="{{ $faculte->id }}">{{ $faculte->name }}</option>
                              @endforeach
                          </select>
                          <label for="recipient-name" class="col-form-label">Kafedra nomi:</label>
                          <input type="text" name="name" class="form-control" required="required"
                              id="recipient-name">
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

  <!-- Guruh qo`shish modal -->
  <div class="modal fade" id="group_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Guruh qo'shish</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('group.store') }}" method="POST" enctype="multipart/form-data">
                      @method('POST')
                      @csrf
                      <label>Fakultet:<span style="color:red;">*</span></label>
                      <select class="form-control" name="faculte_id" required="required">
                          @foreach ($facultes as $faculte)
                              <option value="{{ $faculte->id }}">{{ $faculte->name }}</option>
                          @endforeach
                      </select>
                      <label>Yo'nalish:<span style="color:red;">*</span></label>
                      <select class="form-control" name="direction_id" required="required">
                          @foreach ($directions as $direction)
                              <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                          @endforeach
                      </select>
                      <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Guruh nomi:</label>
                          <input type="text" name="name" class="form-control" id="recipient-name">
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

  <!-- Ilmiy rahbar qo`shish modal -->
  <div class="modal fade" id="teacher_addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ilmiy rahbar qo'shish</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('professor.store') }}" method="POST" enctype="multipart/form-data">
                      @method('POST')
                      @csrf
                      <label>Kafedra:<span style="color:red;">*</span></label>
                      <select class="form-control" name="department_id" required="required">
                          @foreach ($departments as $department)
                              <option value="{{ $department->id }}">{{ $department->name }}</option>
                          @endforeach
                      </select>
                      <div class="form-group">
                          <label for="recipient-name" class="col-form-label">O'qituvchi ism familyasi:</label>
                          <input type="text" name="name" class="form-control" id="recipient-name">
                      </div>
                      <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Email(login):</label>
                          <input type="email" name="email" class="form-control" id="recipient-name">
                      </div>
                      <div class="form-group eyeInput">
                          <label for="recipient-name" class="col-form-label">Parol:</label>
                          <input type="password" name="password" class="form-control" id="recipient-name">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-eye-fill eyeIcon d-none" onclick="showHidePassword(0)"
                              viewBox="0 0 16 16">
                              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                              <path
                                  d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                          </svg>

                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-eye-slash-fill eyeIcon" onclick="showHidePassword(0)" viewBox="0 0 16 16">
                              <path
                                  d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                              <path
                                  d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                          </svg>
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
                      <div class="form-group eyeInputStudent">
                          <label for="recipient-name" class="col-form-label">Parol:</label>
                          <input type="password" name="password" class="form-control">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-eye-fill eyeIcon d-none" onclick="showHidePassword(1)"
                              viewBox="0 0 16 16">
                              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                              <path
                                  d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                          </svg>

                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-eye-slash-fill eyeIcon" onclick="showHidePassword(1)" viewBox="0 0 16 16">
                              <path
                                  d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                              <path
                                  d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                          </svg>
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
      function showHidePassword(i) {
          if ($('input[name="password"]')[i].getAttribute('type') == 'password') {
              $('.bi-eye-fill')[i].classList.remove('d-none');
              $('.bi-eye-slash-fill')[i].classList.add('d-none');
              $('input[name="password"]')[i].setAttribute('type', 'text');
          } else {
              $('.bi-eye-fill')[i].classList.add('d-none');
              $('.bi-eye-slash-fill')[i].classList.remove('d-none');
              $('input[name="password"]')[i].setAttribute('type', 'password');
          }
      }
  </script> --}}
