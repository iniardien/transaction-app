@extends('layout.app')

@section('title', 'Master Barang')
@section('header_title', 'Master Barang')
@section('content')
    <style>
        .table thead th {
            padding: 0.75rem 0.5rem;
        }

        .pagination .page-item.active .page-link {

            color: white;
            /* Warna teks putih untuk item aktif */
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3" data-bs-target="#addModal"
                                data-bs-toggle="modal" id="addModalbtn">Add</a>
                        </div>
                        <div class="col-md-10">
                            <form method="GET" action="{{ route('barang.index') }}">
                                <div class="row" style="float: right">
                                    <div class="col-md-9">
                                        <input type="text" name="search" class="form-control " placeholder="Search..."
                                            value="{{ request()->get('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>



                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentPage = $barangs->currentPage();
                                $perPage = $barangs->perPage();
                                $firstItem = $barangs->firstItem();
                            @endphp

                            @foreach ($barangs as $index => $barang)
                                <tr>
                                    <td class="text-center">{{ $firstItem + $index }}</td>
                                    <td>{{ $barang->kode }}</td>
                                    <td>{{ $barang->nama }}</td>
                                    <td>Rp{{ number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td>{{ $barang->qty }}</td>
                                    <td>
                                        @php
                                            $encryptid = Crypt::encrypt($barang->id);
                                        @endphp
                                        <a href="{{ route('barang.edit', $encryptid) }}" class="btn btn-warning"
                                            data-name="{{ $barang->nama }}" data-kode="{{ $barang->kode }}" data-harga="{{ number_format($barang->harga, 0, ',', '.') }}" data-qty="{{ $barang->qty }}"
                                            data-bs-target="#addModal" data-bs-toggle="modal" id="editModalbtn"><i
                                                class="far fa-edit"></i></a>

                                        <a href="{{ route('barang.delete', $encryptid) }}"
                                            onclick="deletebtn(event,{{ $barang->id }},'{{ route('barang.delete', $encryptid) }}')"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $barangs->links('pagination::bootstrap-5') }}
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Title"></h1>
                    <button type="button" class="btn btn-outline-primary mb-0" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <form id="formType" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">

                                <div class="row mb-3">
                                    <div class="col-3">
                                        <p style="margin-top: 5px">Kode</p>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="kode" id="kode" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <p style="margin-top: 5px">Nama</p>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <p style="margin-top: 5px">Harga</p>
                                    </div>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                            <input type="text" name="harga" id="harga" 
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <p style="margin-top: 5px">Qty</p>
                                    </div>
                                    <div class="col-9">
                                        <input type="number" name="qty" id="qty" class="form-control"
                                            min="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#addModalbtn', function() {
                $('#Title').html('Add Barang');
                $('#nama').val('');
                $('#harga').val('');
                $('#kode').val('');
                $('#qty').val('');
                $('#formType').attr('action', $(this).attr('href'));
            })
            $(document).on('click', '#editModalbtn', function() {
                $('#Title').html('Edit Barang');
                $('#nama').val($(this).data('name'));
                $('#harga').val($(this).data('harga'));
                $('#qty').val($(this).data('qty'));
                $('#kode').val($(this).data('kode'));
                $('#formType').attr('action', $(this).attr('href'));
            })
            $('#harga').on('input', function(e) {
                var value = $(this).val().replace(/\D/g, '');
                $(this).val(formatNumber(value));
            });
        })

        function formatNumber(number) {
            return number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    </script>

@endsection
