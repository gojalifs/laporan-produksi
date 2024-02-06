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
                                <form action="{{ route('product.add') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kode Produk</label>
                                                <input type="text" id="kode" class="form-control" name="code"
                                                    onkeypress="moveToNextField(event, 'name')" required autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
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
                                <h4>Hasil Produksi : {{ $date ?? '' }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>ID Produk</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @if (is_null($products))
                                        @else
                                            @foreach ($products as $i => $p)
                                                <tr>
                                                    <td class="p-0 text-center">{{ $i + 1 }}</td>
                                                    <td class="font-weight-600">{{ $p->id }}</td>
                                                    <td class="text-truncate">{{ $p->code }}</td>
                                                    <td class="align-middle">{{ $p->name }}</td>
                                                    <td class="align-middle">{{ $p->created_at }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a class="btn btn-success"
                                                                href="{{ route('product.update_data', ['id' => $p->id]) }}">Ubah</a>
                                                            <form action="{{ route('product.delete', ['id' => $p->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger"
                                                                    id="btn_delete{{ $p->id }}" type="submit"
                                                                    onclick=" return confirmSubmit()">Hapus</button>
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

        function confirmSubmit() {
            var result = window.confirm("Apakah anda yakin ingin menghapus produk ini?");
            if (result) {
                // If the user clicks "OK," submit the form
                document.getElementById('myForm').submit();
            }
            // If the user clicks "Cancel," do nothing (form won't be submitted)
            return false;
        }
    </script>

@endsection
