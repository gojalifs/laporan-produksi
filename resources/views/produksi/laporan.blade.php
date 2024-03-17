@extends('layouts.index')

@section('content')
    <div class="main-content" style="min-height: 562px">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('production.report_daily') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>Pilih Bagian : </h6>
                                                <div class="form-group">
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        name="bagian">
                                                        @foreach ($bagians as $bagian)
                                                            <option>{{ $bagian }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Pilih Tanggal : </h6>
                                            <input type="date" name="date" required class="form-control datepicker">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Hasil Produksi : {{ $date ?? '' }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>No. LOT</th>
                                            <th>Jumlah</th>
                                            <th>Bagian</th>
                                            <th>Departemen</th>
                                            <th>Status</th>
                                            <th>Waktu</th>
                                        </tr>
                                        @if (is_null($report))
                                        @else
                                            @foreach ($report as $i => $p)
                                                <tr>
                                                    <td class="p-0 text-center">{{ $i + 1 }}</td>
                                                    <td class="font-weight-600">{{ $p->product_id }}</td>
                                                    <td class="font-weight-600">{{ $p->name }}</td>
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
@endsection
