@extends('layouts.index')

@section('content')
    <div class="main-content" style="min-height: 562px">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('employee.add') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Karyawan</label>
                                                <input type="text" id="name" class="form-control" name="name"
                                                    onkeypress="moveToNextField(event, 'email')" tabindex="1" required
                                                    autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" id="email" name="email"
                                                    tabindex="2" onkeypress="moveToNextField(event, 'password')" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <input type="text" class="form-control" id="dept" name="departemen"
                                                    value="departemen" onkeypress="moveToNextField(event, 'password')"
                                                    required readonly>
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
                                                <input type="text" id="password" class="form-control" name="password"
                                                    tabindex="3" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (Session::has('error_delete'))
                            <div class="alert alert-danger">
                                {{ Session::get('error_delete') }}
                            </div>
                        @endif
                        <div id="flash-data" data-flashdata="{{ Session::get('error_delete') }}"></div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Seluruh Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>ID</th>
                                            <th>Nama Karyawan</th>
                                            <th>Email</th>
                                            <th>Departemen</th>
                                            <th>Bagian</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @if (is_null($users))
                                        @else
                                            @foreach ($users as $i => $p)
                                                <tr>
                                                    <td class="p-0 text-center">{{ $i + 1 }}</td>
                                                    <td class="font-weight-600">{{ $p->id }}</td>\
                                                    <td class="align-middle">{{ $p->name }}</td>
                                                    <td class="align-middle">{{ $p->email }}</td>
                                                    <td class="align-middle">{{ $p->departemen }}</td>
                                                    <td class="align-middle">{{ $p->bagian }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a class="btn btn-success"
                                                                href="{{ route('employee.update_data', ['id' => $p->id]) }}">Ubah</a>
                                                            <form action="{{ route('employee.delete', ['id' => $p->id]) }}"
                                                                id="delete_form_{{ $p->id }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger"
                                                                    id="btn_delete{{ $p->id }}" type="submit"
                                                                    onclick=" return confirmSubmit(this.id)">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
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
        }
    </script>

@endsection
