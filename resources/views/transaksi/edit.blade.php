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
                    <form action="{{ route('transaksi.update', Crypt::encrypt($transaksi->id)) }}" id="formTransaksi" method="POST">
                        @csrf
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
                                                <input type="text" class="form-control" name="notransaksi"
                                                    id="notransaksi" readonly value="{{ $transaksi->kode }}">
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
                                                    required value="{{  $date  }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <h3 class="mb-3">Customer</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row form-group">
                                            <input type="text" id="id_customer" hidden name="id_customer" value="{{ $transaksi->cust->id }}">
                                            <div class="col-2">
                                                <label class="label-form" for="kode">Kode</label>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <input type="text" nama="customer_kode" id="customer_kode"
                                                        class="form-control" value="{{ $transaksi->cust->kode }}" readonly placeholder="Search Customer"
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
                                                    id="customer_name" value="{{ $transaksi->cust->name }}" required readonly>
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
                                                    id="customer_telp" value="{{ $transaksi->cust->telp }}" required readonly>
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
                                                                <th rowspan="2"><button type="button" type="button"
                                                                        class="btn btn-success btn-circle" id="addBarang"
                                                                        data-bs-toggle="modal" data-bs-target="#barang"><i
                                                                            class="fas fa-plus text-white"></i></button>
                                                                </th>
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
                                                            <tr id="row_"{{$item->barang->id}}>
                                                                <td ><button type="button" class="btn btn-danger" onclick="deleteRow({{$item->barang->id}})"><i class="fas fa-trash"></i></button></td>
                                                                <td class="text-center"><input type="text" hidden name="barang_id[]" value="{{$item->barang->id}}">{{$loop->iteration}}</td>
                                                                <td style="text-align: left">{{$item->barang->kode}}</td>
                                                                <td style="text-align: left">{{$item->barang->nama}}</td>
                                                                <td style="text-align: left"><input type="number"  value="{{$item->qty}}" class="form-control" id="qty_{{$item->barang->id}}" oninput="updateqty({{$item->barang->id}},{{$item->barang->qty + $item->qty}})" name="qty[]" min="0" max="{{$item->barang->qty + $item->qty}}"></td>
                                                                <td style="text-align: left"><input type="text" class="form-control" id="harga_{{$item->barang->id}}" name="harga_bandrol[]" value="{{$item->harga_bandrol}}" hidden>Rp{{number_format($item->harga_bandrol,2,',','.')}}</td>
                                                                <td style="text-align: left"><input type="number" class="form-control" id="percentage_{{$item->barang->id}}" value="{{round($item->diskon_pct)}}" oninput="updatepercentage({{$item->barang->id}})" name="diskon_pct[]" min="0" max="100"></td>
                                                                <td style="text-align: left"><input type="text" class="form-control" id="discount_{{$item->barang->id}}" value="{{number_format($item->diskon_nilai,0,',','.')}}" name="diskon_nilai[]" oninput="updatediscount({{$item->barang->id}})"></td>
                                                                <td style="text-align: left" id="td_hargadiskon_{{$item->barang->id}}"><input type="text" class="form-control" hidden id="hargadiskon_{{$item->barang->id}}"  name="harga_diskon[]" value="{{number_format($item->harga_diskon,0,',','.')}}"><span id="span_diskon{{$item->barang->id}}">Rp{{number_format($item->harga_diskon,2,',','.')}}</span></td>
                                                                <td style="text-align: left" id="total_{{$item->barang->id}}"><input type="text" class="form-control" hidden id="total_hargainput{{$item->barang->id}}"  name="total_harga[]" value="{{number_format($item->total,0,',','.')}}"><span id="span_total_{{$item->barang->id}}">Rp{{number_format($item->total,2,',','.')}}</span></td>
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
                                    <div class="col-4">
                                        <input type="text" value="{{ number_format($transaksi->subtotal,0,',','.')}}" class="form-control" name="sub_total" id="sub_total"
                                            required readonly>
                                    </div>

                                </div>


                                <div class="row form-group justify-content-end">
                                    <div class="col-2">
                                        <label class="label-form" for="telp">Diskon</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" value="{{ number_format($transaksi->diskon,0,',','.')}}" class="form-control" name="diskon" id="diskon"
                                            required>
                                    </div>

                                </div>
                                <div class="row form-group justify-content-end">
                                    <div class="col-2">
                                        <label class="label-form" for="telp">Ongkir</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" value="{{ number_format($transaksi->ongkir,0,',','.')}}" class="form-control" name="ongkir" id="ongkir"
                                            required>
                                    </div>

                                </div>
                                <div class="row form-group justify-content-end">
                                    <div class="col-2">
                                        <label class="label-form" for="telp">Total Bayar</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="total_bayar" id="total_bayar"
                                            required readonly value="{{ number_format($transaksi->total_bayar,0,',','.')}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
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
    <div class="modal fade" id="barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Title">Pilih Barang</h1>
                    <button type="button" class="btn btn-outline-primary mb-0" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <table id="dataBarang" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th style="text-align: left">Harga</th>
                                        <th style="text-align: left">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td><input type="checkbox" name="barang_id" data-id="{{ $barang->id }}"
                                                    data-kode="{{ $barang->kode }}" data-nama="{{ $barang->nama }}"
                                                    data-harga="{{ $barang->harga }}" data-qty="{{ $barang->qty }}">
                                            </td>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td style="text-align: left">{{ $barang->kode }}</td>
                                            <td style="text-align: left">{{ $barang->nama }}</td>
                                            <td style="text-align: left">
                                                Rp{{ number_format($barang->harga, 2, ',', '.') }}</td>
                                            <td style="text-align: left">{{ $barang->qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="Closemodalbarang"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitBarang" class="btn btn-primary submit_databarang">Pilih</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dataCustomer').DataTable();
            $('#dataBarang').DataTable();
            updateTableWidth();
            
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
                    console.log($('#tgl').val());
                    // Tutup modal
                    $('#Closemodal').click();
                } else {
                    alert('Please select a customer.');
                }
            });
            $('.submit_databarang').on('click', function() {
                $('input[name="barang_id"]:checked').each(function() {
                    var id = $(this).data('id');
                    var kode = $(this).data('kode');
                    var nama = $(this).data('nama');
                    var harga = $(this).data('harga');
                    var qty = $(this).data('qty');
                    var no = $('#tableBarang tbody tr').length + 1;
                    var newRow = `<tr id="row_${id}">
                    <td ><button type="button" class="btn btn-danger" onclick="deleteRow(${id})"><i class="fas fa-trash"></i></button></td>
                    <td class="text-center"><input type="text" hidden name="barang_id[]" value="${id}">${no}</td>
                    <td style="text-align: left">${kode}</td>
                    <td style="text-align: left">${nama}</td>
                    <td style="text-align: left"><input type="number" class="form-control" id="qty_${id}" oninput="updateqty(${id},${qty})" name="qty[]" value="0" min="0" max="${qty}"></td>
                    <td style="text-align: left"><input type="text" class="form-control" id="harga_${id}" name="harga_bandrol[]" value="${harga}" hidden>Rp${formatNumber(harga)}</td>
                    <td style="text-align: left"><input type="number" class="form-control" id="percentage_${id}" oninput="updatepercentage(${id})" name="diskon_pct[]" value="0" min="0" max="100"></td>
                    <td style="text-align: left"><input type="text" class="form-control" id="discount_${id}" name="diskon_nilai[]" value="0" oninput="updatediscount(${id})"></td>
                    <td style="text-align: left" id="td_hargadiskon_${id}"><input type="text" class="form-control" hidden id="hargadiskon_${id}"  name="harga_diskon[]" value="${harga}"><span id="span_diskon${id}">Rp${formatNumber(harga)}</span></td>
                    <td style="text-align: left" id="total_${id}"><input type="text" class="form-control" hidden id="total_hargainput${id}"  name="total_harga[]"><span id="span_total_${id}">Rp0,00</span></td>
                </tr>`;

                    $('#tableBarang tbody').append(newRow);


                });
                $('input[name="barang_id"]:checked').prop('checked', false);
                updateTableWidth();
                $('#Closemodalbarang').click();

            });

            window.deleteRow = function(id) {   
                $(`#row_${id}`).remove();
                updateTableWidth();
                calculateSubTotal();
                diskontotal();

            }


            function updateTableWidth() {
                var tbody = $('#tableBarang tbody');
                if (tbody.children().length === 0) {
                    $('#tableBarang').removeClass('max-content-table').addClass('dynamic-width-table');
                } else {
                    $('#tableBarang').removeClass('dynamic-width-table').addClass('max-content-table');
                }
            }

            function formatNumber(harga) {
                var parts = parseFloat(harga).toFixed(2).split('.');
                var numberPart = parts[0];
                var decimalPart = parts[1];
                var thousands = numberPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return `${thousands},${decimalPart}`;
            }

            function formatInput(number) {
                return number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function parseCurrency(num) {
                return parseFloat(num.replace(/[^0-9.-]+/g, ""));
            }


            function parseSubtotal(num) {
                return parseFloat(num.replace(/\./g, '').replace(',', '.'));
            }

            $('#formTransaksi').on('submit', function(e) {
                e.preventDefault();
                var kode = $('#customer_kode').val();
                if (kode == null || kode == '') {
                    alert('Please select a customer.');
                    return false;
                } else {
                    $(this).off('submit').submit();
                }
            })


            function calculateSubTotal() {
                var subTotal = 0;
                console.log('calculateSubTotal');
                $('input[name^="total_harga"]').each(function() {
                    var total = $(this).val();
                    if (total == '' || total == null) {
                        total = '0.00';
                    }
                    subTotal += parseCurrency(total);
                    console.log(subTotal);
                });

                $('#sub_total').val(formatNumber(subTotal.toFixed(2)));
            }

            window.updateqty = function(id, stock) {
                var qty = $('#qty_' + id).val();
                if (qty > stock) {
                    alert('Jumlah melebihi stok');
                    $('#qty_' + id).val(0);
                    var harga_diskon = $('#hargadiskon_' + id).val();
                    var total = 0 * harga_diskon;
                    $('#span_total_' + id).html('Rp' + formatNumber(total));
                    $('#total_hargainput' + id).val(total);
                    calculateSubTotal();
                    diskontotal();


                } else {
                    var harga_diskon = $('#hargadiskon_' + id).val();
                    var total = qty * harga_diskon;
                    $('#span_total_' + id).html('Rp' + formatNumber(total));
                    $('#total_hargainput' + id).val(total);
                    calculateSubTotal();
                    diskontotal();

                }

            };

            window.updatediscount = function(id) {
                var harga = parseFloat($('#harga_' + id).val());
                var discount = parseFloat($('#discount_' + id).val().replace(/\D/g, ''));
                var discount_show = $('#discount_' + id).val().replace(/\D/g, '');
                console.log(discount, harga);
                if (isNaN(discount)) {
                    discount = 0;
                }
                if (discount > harga) {
                    alert('Diskon melebihi harga');
                    $('#discount_' + id).val(0);
                    $('#percentage_' + id).val(0);
                    var qty = $('#qty_' + id).val();
                    var hargadiskon = 0;
                    var total = qty * harga
                    $('#span_diskon' + id).html('Rp' + formatNumber(harga));
                    $('#span_total_' + id).html('Rp' + formatNumber(total));
                    $('#total_hargainput' + id).val(total);
                    calculateSubTotal();
                    diskontotal();
                } else {
                    $('#discount_' + id).val(formatInput(discount_show));
                    var percentage = Math.round((discount / harga) * 100);
                    var hargadiskon = harga - discount;
                    var qty = $('#qty_' + id).val();
                    var total = qty * hargadiskon;
                    $('#percentage_' + id).val(percentage);
                    $('#span_diskon' + id).html('Rp' + formatNumber(hargadiskon));
                    $('#span_total_' + id).html('Rp' + formatNumber(total));
                    $('#total_hargainput' + id).val(total);
                    calculateSubTotal();
                    diskontotal();

                }
            }

            $('#diskon').on('input', function(e) {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(formatInput(value));
                diskontotal();
            });
            $('#ongkir').on('input', function(e) {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(formatInput(value));
                diskontotal();
            });

            function diskontotal() {
                var sub_total = parseSubtotal($('#sub_total').val());
                var diskon = parseFloat($('#diskon').val().replace(/\D/g, ''));
                var ongkir = parseFloat($('#ongkir').val().replace(/\D/g, ''));
                if (diskon == null || diskon == '' || isNaN(diskon)) {
                    diskon = 0;
                }

                if (ongkir == null || ongkir == '' || isNaN(ongkir)) {
                    ongkir = 0;
                }
                console.log(sub_total, diskon, ongkir);
                var total = (sub_total - diskon) + ongkir;
                $('#total_bayar').val(formatNumber(total.toFixed(2)));
            }


            window.updatepercentage = function(id) {
                var percentage = $('#percentage_' + id).val();
                if (percentage > 100) {
                    alert('Diskon melebihi 100%');
                    var percentage = $('#percentage_' + id).val(0);
                    var harga = $('#harga_' + id).val();
                    var qty = $('#qty_' + id).val();

                    var total = qty * harga;

                    $('#discount_' + id).val('0');
                    $('#hargadiskon_' + id).val(harga);
                    $('#span_diskon' + id).html('Rp' + formatNumber(harga));
                    $('#span_total_' + id).html('Rp' + formatNumber(total));
                    $('#total_hargainput' + id).val(total);
                    calculateSubTotal();
                    diskontotal();

                } else {
                    var discount = $('#discount_' + id).val();
                    var harga = $('#harga_' + id).val();
                    var qty = $('#qty_' + id).val();
                    var harga_diskon = (harga * percentage) / 100;
                    var hargadiskon = harga - harga_diskon;
                    var total = qty * hargadiskon;
                    if (harga_diskon == 0) {
                        $('#discount_' + id).val('0');
                    } else {
                        $('#discount_' + id).val(formatNumber(harga_diskon));
                    }

                    $('#hargadiskon_' + id).val(hargadiskon.toFixed(2));
                    $('#span_diskon' + id).html('Rp' + formatNumber(hargadiskon));
                    $('#span_total_' + id).html('Rp' + formatNumber(total));
                    $('#total_hargainput' + id).val(total);
                    calculateSubTotal();
                    diskontotal();

                }

            }
        })
    </script>
@endsection
