@extends('layouts/admin')
@section('content')
    @include('itb.alerts.main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foydalanuvchi ma'lumotlari</h6>
                </div>
                <div class="card-body">

                    <section class="">

                        <ul>
                            <li class="justify-content-end d-flex"><span><a href="#" data-toggle="modal"
                                        data-target="#profile_editModal" value=""
                                        aria-labelledby="exampleModalLabel">Ma'lumotni
                                        tahrir qilish</a></span>
                            </li>
                            <li class="justify-content-end d-flex"><span><a href="#" data-toggle="modal"
                                        data-target="#password_editModal" value=""
                                        aria-labelledby="exampleModalLabel">
                                        Parolni o'zgartirish</a></span>
                            </li>
                            <li class="">
                                <dl>
                                    <dt>Ism familyanggiz:</dt>
                                    <dd>
                                        {{ $user->name }}
                                    </dd>
                                </dl>
                            </li>
                            <li class="">
                                <dl>
                                    <dt>Logininggiz:</dt>
                                    <dd>
                                        {{ $user->email }}
                                    </dd>
                                </dl>
                            </li>
                            <li class="">
                                <dl>
                                    <dt>Lavoziminggiz:</dt>
                                    @if ($user->role_id == 1)
                                        <dd>Iqtidorli talabalar bo'limi boshlig'i</dd>
                                    @endif
                                </dl>
                            </li>
                        </ul>
                    </section>


                </div>
            </div>
        </div>
        <!-- Ma'lumotlarni tahrirlash modal -->
        <div class="modal fade" id="profile_editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ma'lumotlarni tahrirlash</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">

                                <label for="name">Ism familyangiz: <span class="text-danger">*</span></label>
                                <input type="text" id="name" value="{{ old('name', $user->name) }}"
                                    class="form-control" name="name">

                            </div>
                            <div class="form-group">
                                <label for="email">Loginingiz: <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="form-control">
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
        <!-- Parolni o'zgartirish modal -->
        <div class="modal fade" id="password_editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ma'lumotlarni tahrirlash</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('profile.password')}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">

                                <label for="password">Yangi parol: <span class="text-danger">*</span></label>
                                <input type="password" id="password" class="form-control" name="password">

                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Yangi parolni tasdiqlash: <span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
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
    @endsection
