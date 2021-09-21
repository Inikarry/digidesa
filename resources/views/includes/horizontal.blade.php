<div class="logo-box"><a href="#" class="logo-text">Connect</a></div>
<a href="#" class="hide-horizontal-bar"><i class="material-icons">close</i></a>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="horizontal-bar-menu">
                <ul>
                    <li><a href="/dashboard" class="{{ (request()->routeIs('dashboard')) ? 'active' : '' }}">Dashboard</a></li>
                    <li>
                        <a href="#" class="{{ (request()->routeIs('umum.*')) ? 'active' : '' }}">Umum<i class="material-icons">keyboard_arrow_down</i></a>
                        <ul>
                            <li>
                                <a href="/buku-keputusan" class="{{ (request()->routeIs('umum.buku-keputusan')) ? 'active' : '' }}">Buku Keputusan Camat</a>
                            </li>
                            <li>
                                <a href="/buku-inventaris" class="{{ (request()->routeIs('umum.buku-inventaris')) ? 'active' : '' }}">Buku Inventaris</a>
                            </li>
                            <li>
                                <a href="/buku-cuti" class="{{ (request()->routeIs('umum.buku-cuti')) ? 'active' : '' }}">Buku Cuti</a>
                            </li>
                            <li>
                                <a href="/buku-agenda" class="{{ (request()->routeIs('umum.buku-agenda')) ? 'active' : '' }}">Buku Agenda</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#" class="{{ (request()->routeIs('penduduk.*')) ? 'active' : '' }}">Penduduk<i class="material-icons">keyboard_arrow_down</i></a>
                        <ul>
                            <li>
                                <a href="/buku-induk-penduduk" class="{{ (request()->routeIs('penduduk.buku_induk_penduduk')) ? 'active' : '' }}">Laporan Penduduk Kecamatan</a>
                            </li>
                            <li>
                                <a href="/buku-rekapitulasi" class="{{ (request()->routeIs('penduduk.buku_rekapitulasi')) ? 'active' : '' }}">Laporan Pencatatan Perkawinan</a>
                            </li>
                            <li>
                                <a href="/buku-penduduk" class="{{ (request()->routeIs('penduduk.buku_penduduk')) ? 'active' : '' }}">Laporan Pencatatan Kematian</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#" class="{{ (request()->routeIs('kelembagaan.*')) ? 'active' : '' }}">Kelembagaan<i class="material-icons">keyboard_arrow_down</i></a>
                        <ul>
                            <li>
                                <a href="/data-anggota-pkk" class="{{ (request()->routeIs('kelembagaan.data_pkk')) ? 'active' : '' }}">Daftar Urut Kepangkatan</a>
                            </li>
                            <li>
                                <a href="/buku-gaji" class="{{ (request()->routeIs('kelembagaan.buku-gaji')) ? 'active' : '' }}">Buku Kenaikan Gaji Berkala</a>
                            </li>
                            <li>
                                <a href="/data-anggota-posyandu" class="{{ (request()->routeIs('kelembagaan.data_posyandu')) ? 'active' : '' }}">Buku Kenaikan Pangkat Pegawai</a>
                            </li>
                            <li>
                                <a href="/buku-rekomendasimasuk" class="{{ (request()->routeIs('kelembagaan.buku-rekomendasimasuk')) ? 'active' : '' }}">Buku Rekomendasi Pemberhentian & Pengangkatan Perangkat Desa (Surat Masuk)</a>
                            </li>
                             <li>
                                <a href="/buku-rekomendasikeluar" class="{{ (request()->routeIs('kelembagaan.buku-rekomendasikeluar')) ? 'active' : '' }}">Buku Rekomendasi Pemberhentian & Pengangkatan Perangkat Desa (Surat Keluar)</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="charts.html">User</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>