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
                        <div id="flash-data" data-flashdata="{{ Session::get('error') }}"></div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('barcode.generate') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>Pilih Produk : </h6>
                                                <div class="form-group">
                                                    <input type="number" name="id" class="form-control" id="id"
                                                        value="{{ $products[0]->id }}" required hidden>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        onchange="changeId(this.value)" name="bagian">
                                                        @foreach ($products as $product)
                                                            <option id="{{ $product->id }}" value="{{ $product->id }}">
                                                                {{ $product->code }} {{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Jumlah : </h6>
                                            <input type="number" name="quantity" class="form-control" required autofocus>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary mr-1">Submit</button>
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
        function changeId(id) {
            console.log(document.getElementById("id").value);
            console.log(id);
            document.getElementById("id").value = id;            
            console.log(document.getElementById("id").value);
        }
    </script>
@endsection
