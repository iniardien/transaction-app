@extends('layout.app')

@section('title', 'Master Customer')
@section('header_title', 'Master Customer')
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
                            <a href="{{ route('customer.create') }}" class="btn btn-primary mb-3" data-bs-target="#addModal"
                                data-bs-toggle="modal" id="addModalbtn">Add</a>
                        </div>
                        <div class="col-md-10">
                            <form method="GET" action="{{ route('customer.index') }}">
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
                                <th>No Telp</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $currentPage = $customers->currentPage();
                                $perPage = $customers->perPage();
                                $firstItem = $customers->firstItem();
                            @endphp

                            @foreach ($customers as $index => $customer)
                                <tr>
                                    <td class="text-center">{{ $firstItem  + $index }}</td>
                                    <td>{{ $customer->kode }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->telp }}</td>
                                    <td>
                                        @php
                                            $encryptid = Crypt::encrypt($customer->id);
                                        @endphp
                                        <a href="{{ route('customer.edit', $encryptid) }}" class="btn btn-warning"
                                            data-name="{{ $customer->name }}" data-telp ="{{ $customer->telp }}" data-kode="{{ $customer->kode }}"
                                            data-bs-target="#addModal" data-bs-toggle="modal" id="editModalbtn"><i
                                                class="far fa-edit"></i></a>
                                                
                                        <a href="{{ route('customer.delete', $encryptid) }}" onclick="deletebtn(event,{{ $customer->id }},'{{ route('customer.delete', $encryptid) }}')" class="btn btn-danger"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $customers->links('pagination::bootstrap-5') }}
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
                                        <p style="margin-top: 5px">No telp</p>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="no_telp" id="no_telp" pattern="[0-9]*"
                                            class="form-control" required>
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
                $('#Title').html('Add Customer');
                $('#nama').val('');
                $('#kode').val('');
                $('#no_telp').val('');
                $('#formType').attr('action', $(this).attr('href'));
            })
            $(document).on('click','#editModalbtn', function() {
                $('#Title').html('Edit Customer');
                $('#nama').val($(this).data('name'));
                $('#kode').val($(this).data('kode'));
                $('#no_telp').val($(this).data('telp'));
                $('#formType').attr('action', $(this).attr('href'));
            })
            $('#no_telp').on('input', function(e) {
                var value = $(this).val();
                if (/[^0-9]/.test(value)) {
                    alert('Hanya boleh input angka');
                    $(this).val(value.replace(/[^0-9]/g, ''));
                }
            });
        })
    </script>

@endsection
