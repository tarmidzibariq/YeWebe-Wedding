@extends('layouts.master')
@section('content')


<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">

        {{-- alert success --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card mb-4">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Jumlah Order</th>
                                <th>Total Harga</th>
                                <th>Status Publish</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catalogues as $catalogue)
                            <tr class="text-capitalize">
                                <td>{{ $catalogue->id }}</td>
                                <td><a href="" class="btn-show-detail" data-id="{{ $catalogue->id }}" data-bs-toggle="modal" data-bs-target="#catalogueModal">{{ $catalogue->package_name }}</a></td>
                                <td>{{ $catalogue->order_count }}</td>
                                <td>Rp {{ number_format($catalogue->price * $catalogue->order_count, 0, ',', '.') }}</td>
                                {{-- <td>{{ $catalogue->catalogue->pluck('wedding_date')->map(function($date){ return $date->format('d/m/Y'); })->implode(', ') }}</td> --}}
                                <td>{{ $catalogue->status_publish }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal kosong untuk show, akan diisi konten AJAX -->
                <div class="modal fade" id="catalogueModal" tabindex="-1" aria-labelledby="catalogueModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="catalogueModalContent">
                            <!-- Konten modal akan di-load via AJAX -->
                            <div class="modal-body text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $catalogues->appends(request()->query())->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
         $(document).ready(function () {
            $('.btn-show-detail').on('click', function () {
                let catalogueId = $(this).data('id');
                let modalContent = $('#catalogueModalContent');

                modalContent.html(`
            <div class="modal-body text-center">
                <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            `);

                $.ajax({
                    url: `/admin/catalogue/${catalogueId}`, 
                    method: 'GET',
                    success: function (response) {
                        modalContent.html(response); // Load ke dalam modal
                    },
                    error: function () {
                        modalContent.html(
                            '<div class="modal-body text-danger">Failed to load data.</div>'
                            );
                    }
                });
            });

        });
    </script>
@endpush    
