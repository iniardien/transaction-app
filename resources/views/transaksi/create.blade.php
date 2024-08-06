@extends('layout.app')

@section('title', 'Create Transaksi')
@section('header_title', 'Create Transaksi')
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
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h3 class="mb-3">Transaksi</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" id="id_customer" hidden name="id_customer">
                                        <div class="row form-group">
                                            <div class="col-2">
                                                <label class="label-form" for="no">No</label>
                                            </div>

                                            <div class="col-6">
                                                <input type="text" class="form-control" name="no" id="no"
                                                    readonly value="{{ $notransaksi }}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row form-group">
                                            <div class="col-2">
                                                <label class="label-form" for="tgl">Tanggal</label>
                                            </div>

                                            <div class="col-6">
                                                <input type="date" class="form-control" name="tgl" id="tgl"
                                                    required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <h3 class="mb-3">Customer</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row form-group">
                                            <div class="col-2">
                                                <label class="label-form" for="kode">Kode</label>
                                            </div>

                                            <div class="col-6">

                                                <div class="input-group">
                                                    <input type="text" nama="customer_kode" id="customer_kode"
                                                        class="form-control" readonly placeholder="Search Customer"
                                                        aria-label="Search Customer" aria-describedby="button-addon2">
                                                    <button class="btn btn-outline-primary mb-0" type="button"
                                                        id="button-addon2" data-bs-toggle="modal"
                                                        data-bs-target="#customer"><i class="fas fa-search"></i></button>
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
                                                <input type="text" class="form-control" name="nama_customer"
                                                    id="customer_name" required readonly>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row form-group">
                                            <div class="col-2">
                                                <label class="label-form" for="telp">Telp</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="telp_customer"
                                                    id="customer_telp" required readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <h3 class="mb-3">Barang</h3>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="row form-group">
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success btn-circle " id="addBarang"
                                                    data-bs-dismiss="modal" data-bs-target="#barang"><i
                                                        class="fas fa-plus text-white"></i></button>
                                            </div>

                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="tableBarang">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2"></th>
                                                                <th rowspan="2">No</th>
                                                                <th rowspan="2">Kode Barang</th>
                                                                <th rowspan="2">Nama Barang</th>
                                                                <th rowspan="2">Qty</th>
                                                                <th rowspan="2">Harga Bandrol</th>
                                                                <th colspan="2">Diskon</th>
                                                                <th rowspan="2">Harga Diskon</th>
                                                                <th rowspan="2">Total</th>
                                                            </tr>
                                                            <tr>

                                                                <th>%</th>
                                                                <th>(Rp)</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>

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
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="telp_customer"
                                            id="customer_telp" required readonly>
                                    </div>

                                </div>

                                
                                <div class="row form-group justify-content-end">
                                    <div class="col-2">
                                        <label class="label-form" for="telp">Diskon</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="telp_customer"
                                            id="customer_telp" value="0" required>
                                    </div>

                                </div>
                                <div class="row form-group justify-content-end">
                                    <div class="col-2">
                                        <label class="label-form" for="telp">Ongkir</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="telp_customer"
                                            id="customer_telp" required>
                                    </div>

                                </div>
                                <div class="row form-group justify-content-end">
                                    <div class="col-2">
                                        <label class="label-form" for="telp">Total Bayar</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="telp_customer"
                                            id="customer_telp" required readonly>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Title">Pilih Customer</h1>
                    <button type="button" class="btn btn-outline-primary mb-0" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <table id="dataCustomer" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Customer</th>
                                        <th>Telp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td><input type="radio" name="customer_id" data-id="{{ $customer->id }}"
                                                    data-kode="{{ $customer->kode }}" data-name="{{ $customer->name }}"
                                                    data-telp="{{ $customer->telp }}"></td>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $customer->kode }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td style="text-align: left">{{ $customer->telp }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="Closemodal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submit" class="btn btn-primary submit_data">Pilih</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dataCustomer').DataTable();

            $('.submit_data').on('click', function() {
                var selectedCustomer = $('input[name="customer_id"]:checked');
                if (selectedCustomer.length > 0) {
                    var customerName = selectedCustomer.data('name');
                    var customerId = selectedCustomer.data('id');
                    var customerKode = selectedCustomer.data('kode');
                    var customerTelp = selectedCustomer.data('telp');

                    $('#id_customer').val(customerId);
                    $('#customer_name').val(customerName);
                    $('#customer_kode').val(customerKode);
                    $('#customer_telp').val(customerTelp);

                    // Tutup modal
                    $('#Closemodal').click();
                } else {
                    alert('Please select a customer.');
                }
            });
        })
    </script>
@endsection
