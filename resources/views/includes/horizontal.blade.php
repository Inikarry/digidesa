<div class="logo-box"><a href="#" class="logo-text">Connect</a></div>
                    <a href="#" class="hide-horizontal-bar"><i class="material-icons">close</i></a>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="horizontal-bar-menu">
                                    <ul>
                                        <li><a href="index.html" class="active">Dashboard</a></li>
                                        <li>
                                            <a href="#">Umum<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="mailbox.html">Peraturan Desa</a>
                                                </li>
                                                <li>
                                                    <a href="profile.html">Buku Keputusan Kepala Desa</a>
                                                </li>
                                                <li>
                                                    <a href="file-manager.html">Buku Aparat Pemerintah Desa</a>
                                                </li>
                                                <li>
                                                    <a href="calendar.html">Buku Agenda</a>
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
                                        <li><a href="#">Keuangan<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="ui-alerts.html">Buku APB Desa</a>
                                                </li>
                                                <li>
                                                    <a href="ui-badge.html">Buku Rencana Anggaran Biaya</a>
                                                </li>
                                                <li>
                                                    <a href="ui-breadcrumb.html">Buku Kas Pembantu Kegiatan</a>
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
                                        <li><a href="#">Pembangunan<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="extended-select2.html">Buku Rencana Kerja Pembangunan</a>
                                                </li>
                                                <li>
                                                    <a href="extended-datatables.html">Buku Kegiatan Pembangunan</a>
                                                </li>
                                                <li>
                                                    <a href="extended-blockui.html">Buku Inventaris Hasil Pembangunan</a>
                                                </li>
                                                <li>
                                                    <a href="extended-session.html">Buku Kader Pemberdayaan Masyarakat</a>
                                                </li>
                                            </ul>
                                        <li><a href="#">Kelembagaan<i class="material-icons">keyboard_arrow_down</i></a>
                                            <ul>
                                                <li>
                                                    <a href="extended-select2.html">Data Anggota PKK</a>
                                                </li>
                                                <li>
                                                    <a href="extended-datatables.html">Data Anggota LPMD</a>
                                                </li>
                                                <li>
                                                    <a href="extended-blockui.html">Data Anggota Posyandu</a>
                                                </li>
                                                <li>
                                                    <a href="extended-session.html">Data Anggota LPMD</a>
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