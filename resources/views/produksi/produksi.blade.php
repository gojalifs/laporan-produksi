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
                    <div class="col-12 col-md-12 col-lg-12">
                        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                        <div id="flash-data" data-flashdata="{{ Session::get('error') }}"></div>
                        <Form method="POST" action="{{ route('production.add') }}" id="production_form">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Tambah Produksi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Product ID</label>
                                                <input type="hidden" class="form-control" name="user_id"
                                                    value="{{ $user->id }}">
                                                <input type="text" id="product_id" {{-- onkeypress="moveToNextField(event, 'lot_number')" --}}
                                                    class="form-control" name="product_id" autofocus required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>LOT Number</label>
                                                <input type="text" id="lot_number" class="form-control datepicker"
                                                    name="lot_number" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <input type="text" class="form-control" name="departemen" disabled
                                                    value="{{ $user->departemen }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bagian</label>
                                                <input type="text" class="form-control" name="bagian" disabled
                                                    value="{{ $user->bagian }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="OK">OK</option>
                                                    <option value="NG">NG</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    </div>
                                </div>
                        </Form>
                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Produksi Hari Ini : {{ $date }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kode Produk</th>
                                    <th>No. LOT</th>
                                    <th>Jumlah</th>
                                    <th>Bagian</th>
                                    <th>Departemen</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                </tr>
                                @foreach ($production as $i => $p)
                                    <tr>
                                        <td class="p-0 text-center">{{ $i + 1 }}</td>
                                        <td class="font-weight-600">{{ $p->product_id }}</td>
                                        <td class="text-truncate">{{ $p->lot_number }}</td>
                                        <td class="align-middle">1 Box (30 pcs)</td>
                                        <td class="align-middle">{{ $p->bagian }}</td>
                                        <td class="align-middle">{{ $p->departemen }}</td>
                                        <td class="align-middle">
                                            @if ($p->status == 'OK')
                                                <span class="badge badge-success">{{ $p->status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $p->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $p->created_at }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $production->links('pagination::bootstrap-4') }}

    </div>
@endsection
