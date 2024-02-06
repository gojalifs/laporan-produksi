@extends('layouts.index')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-cyan-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Semangat</h4>
                                <span>{{ $date }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">{{ $produksi['total'] }} Pcs</h4>
                                <span>Hasil kemarin, {{ $user->bagian }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card l-bg-green-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">{{ $produksi['today'] }} Pcs</h4>
                                <span>Hasil Hari Ini, {{ $user->bagian }}</span>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
