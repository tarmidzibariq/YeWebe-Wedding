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
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{route('admin.catalogue.create')}}" class="btn btn-primary">Create</a>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created At</th>
                                <th>Package Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catalogues as $item)
                            <tr>
                                <td>#{{$item->id}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i')}}</td>
                                <td>{{$item->package_name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{'Rp '.number_format($item->price, 0, ',', '.')}}</td>
                                <td>{{$item->status_publish}}</td>
                                <td>
                                    {{-- Tombol untuk membuka modal detail mobil --}}
                                    <button type="button" class="btn btn-sm btn-info btn-show-detail"
                                        data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#catalogueModal">
                                        Show
                                    </button>
                                    {{-- Tombol edit --}}
                                    <a href="{{ route('admin.catalogue.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    {{-- Form untuk delete dengan konfirmasi --}}
                                    <form action="{{ route('admin.catalogue.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
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

@push('scripts')
{{-- jquery --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

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
@endsection