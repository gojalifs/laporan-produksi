<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('index') }}"> <span class="logo-name">Dashboard</span>
            </a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img alt="image"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTcZsL6PVn0SNiabAKz7js0QknS2ilJam19QQ&usqp=CAU">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->bagian }}</div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="nav-link" href="{{ route('index') }}">
                    <img src="{{ asset('img/svg/home.svg') }}" style="margin-right:6px">
                    <span>Dashboard</span> </a>
            </li>
            @if (Auth::user()->bagian != 'Admin Produksi')
                <li>
                    <a href="{{ route('production') }}" class="nav-link">
                        <img src="{{ asset('img/svg/product.svg') }}" style="margin-right:6px">
                        <span>Mulai Produksi</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('product') }}" class="nav-link">
                        <img src="{{ asset('img/svg/product.svg') }}" style="margin-right:6px">
                        <span>Tambah Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('employees') }}" class="nav-link">
                        <img src="{{ asset('img/svg/user.svg') }}" style="margin-right:6px">
                        <span>Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('production.report') }}" class="nav-link">
                        <img src="{{ asset('img/svg/report.svg') }}" style="margin-right:6px">
                        <span>Laporan Produksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('barcode') }}" class="nav-link">
                        <img src="{{ asset('img/svg/barcode.svg') }}" style="margin-right: 6px">
                        <span>Barcode</span>
                    </a>
                </li>
            @endif

        </ul>
    </aside>
</div>
