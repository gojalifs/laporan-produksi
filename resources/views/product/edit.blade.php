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
                                <form action="{{ route('product.update') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kode Produk</label>
                                                <input type="text" id="kode" class="form-control" name="id"
                                                    value="{{ $product->id }}"
                                                    required autofocus hidden>
                                                <input type="text" id="kode" class="form-control" name="code"
                                                    value="{{ $product->code }}" onkeypress="moveToNextField(event, 'name')"
                                                    required autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $product->name }}" required>
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
@endsection
