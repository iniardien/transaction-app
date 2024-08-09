@extends('layout.app')

@section('title', 'Detail')
@section('header_title', 'Detail')
@section('content')
    <style>
        .table thead th {
            padding: 0.75rem 0.5rem;
        }

        .pagination .page-item.active .page-link {

            color: white;
            /* Warna teks putih untuk item aktif */
        }

        .label-form {
            font-size: 18px
        }

        .btn-circle {
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            border-radius: 50%;
            font-size: 16px;
            text-align: center;

        }


        /* Mengatur teks agar berada di tengah */
        thead th,
        tbody th,
        tbody td {
            text-align: center;
            vertical-align: middle;
        }

        /* Mengatur border agar lebih halus */
        table {
            border-collapse: collapse;
        }

        /* Mengatur garis horizontal pada sel */
        th,
        td {
            border-bottom: 1px solid #dee2e6;
        }

        /* Mengatur lebar kolom agar proporsional */
        th[colspan="2"] {
            width: calc(2 * (100% / 10));
            /* Adjust as necessary */
        }

        .dynamic-width-table {
            width: 100%;
        }

        .max-content-table {
            width: max-content;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-primary mb-3">Kembali</a>
                        </div>
                        <div class="col-md-10">

                        </div>


                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h3 class="mb-3">Transaksi</h3>
                            <div class="row">
                                <div class="col-12">

                                    <div class="row form-group">
                                        <div class="col-2">
                                            <label class="label-form" for="no">No</label>
                                        </div>

                                        <div class="col-6">
                                            <label for="notransaksi" class="label-form">: {{ $transaksi->kode }}</label>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row form-group">
                                        <div class="col-2">
                                            <label class="label-form" for="tgl">Tanggal</label>
                                        </div>

                                        <div class="col-6">
                                            <label for="notransaksi" class="label-form">:
                                                {{ \Carbon\Carbon::parse($transaksi->tgl)->format('d-M-Y') }}</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-3">Customer</h3>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row form-group">
                                        <input type="text" id="id_customer" hidden name="id_customer">
                                        <div class="col-2">
                                            <label class="label-form" for="kode">Kode</label>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">

                                                <label for="kode" class="label-form">:
                                                    {{ $transaksi->cust->kode }}</label>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row form-group mb-4">
                                        <div class="col-2">
                                            <label class="label-form" for="nama">Nama</label>
                                        </div>

                                        <div class="col-6">
                                            <label for="kode" class="label-form">: {{ $transaksi->cust->name }}</label>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row form-group">
                                        <div class="col-2">
                                            <label class="label-form" for="telp">Telp</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="telp" class="label-form">: {{ $transaksi->cust->telp }}</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-3">Barang</h3>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped dynamic-width-table" id="tableBarang">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th rowspan="2">No</th>
                                                            <th rowspan="2">Kode Barang</th>
                                                            <th rowspan="2">Nama Barang</th>
                                                            <th rowspan="2" style="width: 15%">Qty</th>
                                                            <th rowspan="2">Harga Bandrol</th>
                                                            <th colspan="2">Diskon</th>
                                                            <th rowspan="2">Harga Diskon</th>
                                                            <th rowspan="2">Total</th>
                                                        </tr>
                                                        <tr>

                                                            <th style="width: 15%">%</th>
                                                            <th style="width: 20%">(Rp)</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($salesdetail as $item)
                                                            <tr>
                                                               
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->barang->kode }}</td>
                                                                <td>{{$item->barang->nama}}</td>
                                                                <td>{{$item->qty}}</td>
                                                                <td>Rp{{ number_format($item->harga_bandrol, 2, ',', '.')}}</td>
                                                                <td>{{number_format($item->diskon_pct, 0, ',', '.')}}%</td>
                                                                <td>Rp{{ number_format($item->diskon_nilai, 2, ',', '.') }}</td>
                                                                <td>Rp{{ number_format($item->harga_diskon, 2, ',', '.') }}</td>
                                                                <td>Rp{{ number_format($item->total, 2, ',', '.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row form-group justify-content-end">
                                <div class="col-2">
                                    <label class="label-form" for="telp">Sub Total</label>
                                </div>
                                <div class="col-2">
                                    <label for="sub_total" class="label-form">:
                                        Rp{{ number_format($transaksi->subtotal, 2, ',', '.') }}</label>
                                </div>

                            </div>


                            <div class="row form-group justify-content-end">
                                <div class="col-2">
                                    <label class="label-form" for="telp">Diskon</label>
                                </div>
                                <div class="col-2">
                                    <label for="diskon" class="label-form">:
                                        Rp{{ number_format($transaksi->diskon, 2, ',', '.') }}</label>
                                </div>

                            </div>
                            <div class="row form-group justify-content-end">
                                <div class="col-2">
                                    <label class="label-form" for="telp">Ongkir</label>
                                </div>
                                <div class="col-2">
                                    <label for="ongkir" class="label-form">:
                                        Rp{{ number_format($transaksi->ongkir, 2, ',', '.') }}</label>
                                </div>

                            </div>
                            <div class="row form-group justify-content-end">
                                <div class="col-2">
                                    <label class="label-form" for="telp">Total Bayar</label>
                                </div>
                                <div class="col-2">
                                    <label for="total_bayar" class="label-form">:
                                        Rp{{ number_format($transaksi->total_bayar, 2, ',', '.') }}</label>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
