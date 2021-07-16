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
                                                    <a href="/peraturan-desa" class="{{ (request()->routeIs('umum.peraturan-desa')) ? 'active' : '' }}">Peraturan Desa</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-keputusan" class="{{ (request()->routeIs('umum.buku-keputusan')) ? 'active' : '' }}">Buku Keputusan Kepala Desa</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-aparat" class="{{ (request()->routeIs('umum.buku-aparat')) ? 'active' : '' }}">Buku Aparat Pemerintah Desa</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-agenda" class="{{ (request()->routeIs('umum.buku-agenda')) ? 'active' : '' }}">Buku Agenda</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#" class="{{ (request()->routeIs('penduduk.*')) ? 'active' : '' }}">Penduduk<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="/buku-induk-penduduk" class="{{ (request()->routeIs('penduduk.buku_induk_penduduk')) ? 'active' : '' }}">Buku Induk Penduduk</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-mutasi" class="{{ (request()->routeIs('penduduk.buku_mutasi')) ? 'active' : '' }}">Buku Mutasi Penduduk Desa</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-rekapitulasi" class="{{ (request()->routeIs('penduduk.buku_rekapitulasi')) ? 'active' : '' }}">Buku Rekapitulasi Jumlah Penduduk</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-penduduk" class="{{ (request()->routeIs('penduduk.buku_penduduk')) ? 'active' : '' }}">Buku Penduduk Sementara</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-ktp" class="{{ (request()->routeIs('penduduk.buku_ktp')) ? 'active' : '' }}">Buku KTP dan Buku KK</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#" class="{{ (request()->routeIs('keuangan.*')) ? 'active' : '' }}" >Keuangan<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="/buku-apb-desa" class="{{ (request()->routeIs('keuangan.apbdesa')) ? 'active' : '' }}" >Buku APB Desa</a> 
                                                </li>
                                                <li>
                                                    <a href="/buku-rab-desa" class="{{ (request()->routeIs('keuangan.rabdesa')) ? 'active' : '' }}">Buku RAB Desa</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-kaspemkeg-desa" class="{{ (request()->routeIs('keuangan.kaspemkegdesa')) ? 'active' : ''}}">Buku Kaspemkeg Desa</a>
                                                </li>
                                                <li>
                                                    <a href="ui-buttons.html">Buku Kas Umum</a>
                                                </li>
                                                <li>
                                                    <a href="ui-card.html">Buku Kas Pembantu</a>
                                                </li>
                                                <li>
                                                    <a href="ui-collapse.html">Buku Bank Desa</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#" class="{{ (request()->routeIs('pembangunan.*')) ? 'active' : '' }}">Pembangunan<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="/buku-rencana" class="{{ (request()->routeIs('pembangunan.buku_rencana')) ? 'active' : '' }}">Buku Rencana Kerja Pembangunan</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-kegiatan" class="{{ (request()->routeIs('pembangunan.buku_kegiatan')) ? 'active' : '' }}">Buku Kegiatan Pembangunan</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-inventaris" class="{{ (request()->routeIs('pembangunan.buku_inventaris')) ? 'active' : '' }}">Buku Inventaris Hasil Pembangunan</a>
                                                </li>
                                                <li>
                                                    <a href="/buku-kader" class="{{ (request()->routeIs('pembangunan.buku_kader')) ? 'active' : '' }}">Buku Kader Pemberdayaan Masyarakat</a>
                                                </li>
                                            </ul>
                                        <li><a href="#" class="{{ (request()->routeIs('kelembagaan.*')) ? 'active' : '' }}">Kelembagaan<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="/data-anggota-pkk" class="{{ (request()->routeIs('kelembagaan.data_pkk')) ? 'active' : '' }}">Data Anggota PKK</a>
                                                </li>
                                                <li>
                                                    <a href="/data-anggota-lpmd" class="{{ (request()->routeIs('kelembagaan.data_lpmd')) ? 'active' : '' }}">Data Anggota LPMD</a>
                                                </li>
                                                <li>
                                                    <a href="/data-anggota-posyandu" class="{{ (request()->routeIs('kelembagaan.data_posyandu')) ? 'active' : '' }}">Data Anggota Posyandu</a>
                                                </li>
                                                <li>
                                                    <a href="/data-anggota-bpd" class="{{ (request()->routeIs('kelembagaan.data_bpd')) ? 'active' : '' }}">Data Anggota BPD</a>
                                                </li>
                                            </ul>
                                        <li><a href="charts.html">User</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>