@extends('layouts.index')

@section('content')
    <script>
        function moveToNextField(event, nextFieldId) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById(nextFieldId).focus();
            }
        }
    </script>

    <div class="main-content" style="min-height: 562px">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('employee.update') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Karyawan</label>
                                                <input type="text" id="id" class="form-control" name="id"
                                                    value="{{ $user->id }}" onkeypress="moveToNextField(event, 'email')"
                                                    required hidden>
                                                <input type="text" id="name" class="form-control" name="name"
                                                    value="{{ $user->name }}" onkeypress="moveToNextField(event, 'email')"
                                                    tabindex="1" required autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{ $user->email }}" tabindex="2"
                                                    onkeypress="moveToNextField(event, 'password')" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <input type="text" class="form-control" id="dept" name="departemen"
                                                    value="{{ $user->departemen }}"
                                                    onkeypress="moveToNextField(event, 'password')" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                                <label>Bagian</label>
                                                <input type="text" name="bagian" id="bagian" value="Press Welding"
                                                    hidden></input>
                                                <div class="form-group">
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        name="bagian">
                                                        @foreach ($bagian as $item)
                                                            <option>{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kata Sandi Baru</label>
                                                <input type="text" id="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin diubah"
                                                    tabindex="3" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function disableButton(id) {
            // Disable the button
            document.getElementById('btn_delete' + id).disabled = true;
        }

        function confirmSubmit(id) {
            var result = window.confirm("Apakah anda yakin ingin menghapus akun ini?");
            if (result) {
                // If the user clicks "OK," submit the form
                document.getElementById('delete_form_' + id).submit();
            }
            // If the user clicks "Cancel," do nothing (form won't be submitted)
            return false;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function moveToNextField(event, nextFieldId) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById(nextFieldId).focus();
            }
        }

        function selectOption(option) {
            $('.dropdownBagian').html(option);
            document.getElementById("bagian").value = option;
        }
    </script>
@endsection
