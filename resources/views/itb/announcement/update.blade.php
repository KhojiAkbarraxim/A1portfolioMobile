
@extends('layouts.admin')
@section('content')
    @include('itb.alerts.main')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tanlovni tahrirlash</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('announcement.update', $tanlov->id) }}" method="POST" enctype="multipart/form-data"
                onsubmit="return copyContent()">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label">Tanlov nomi:</label>
                    <input type="text" name="name" value="{{ $tanlov->name }}" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="image" class="col-form-label">Tanlov rasmi:</label>
                    <input type="file" accept="image/png, image/jpg, image/jpeg" name="image" value="" class="form-control" id="image">
                </div>
                <div class="form-group">
                    <img src="/storage/{{$tanlov->image}}" width="200px" class="img img-thumbnail" alt="">
                </div>
                <div class="form-group">
                    <label for="deadline" class="col-form-label">Ariza qabul qilish muddati:</label>
                    {{-- {{dd($tanlov->app_begin)}} --}}
                    <input type="date" name="ariza_begin" value="{{ date('Y-m-d', strtotime($tanlov->app_begin))}}" id="deadline"> dan
                    <input type="date" name="ariza_end" value="{{ date('Y-m-d', strtotime($tanlov->app_deadline)) }}"> gacha
                </div>
                <div class="form-group">
                    <label for="sana" class="col-form-label">Tanlov sanasi:</label>
                    <input type="date" name="tanlov_begin" value="{{ date('Y-m-d', strtotime($tanlov->selection_begin)) }}" id="sana"> dan
                    <input type="date" name="tanlov_end" value="{{ date('Y-m-d', strtotime($tanlov->selection_date))  }}"> gacha
                </div>
                <div class="form-group">
                    <label class="col-form-label">Umumiy ma'lumot</label>
                    <textarea name="description" id="description" class="d-none" value=""></textarea>
                    <div id="editor">{!!$tanlov->description !!}</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right">Saqlash</button>
                </div>
                <div class="alert alert-danger alert-dismissible fade" role="alert" id="descriptionAlert">
                    <strong>Diqqat!</strong> Siz "Umumiy ma'lumot" maydonini to'ldirishingiz kerak!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </form>

        </div>





        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });

            function copyContent() {
                const childs = document.querySelector("div.ck.ck-content").childNodes;
                let notEmptyChilds = 0;
                childs.forEach(child => {
                    let firstLetters = child.innerText.slice(0, 1);
                    if (firstLetters != "\n") {
                        notEmptyChilds++
                    }
                });

                if (notEmptyChilds > 0) {
                    document.getElementById("description").value =
                        document.querySelector("div.ck.ck-content").innerHTML;
                    return true;
                } else {
                    // alert('Descriptionni to\'ldirmadingiz!');
                    // if (document.getElementById('descriptionAlert').classList.contains('show')) {

                    // }
                    // document.getElementById('descriptionAlert').classList.
                    return false;
                }

            }
        </script>
    @endsection
