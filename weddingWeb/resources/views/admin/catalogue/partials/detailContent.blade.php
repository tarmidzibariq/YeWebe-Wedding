<div class="modal-header">
  <h5 class="modal-title" id="catalogueModalLabel">Catalogue Detail: {{ $catalogue->package_name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <table class="table table-bordered text-capitalize">
    <tr><th>ID</th><td>{{ $catalogue->id }}</td></tr>
    <tr><th>Package Name</th><td>{{ $catalogue->package_name }}</td></tr>
    <tr><th>Description</th><td>{{ $catalogue->description }}</td></tr>
    <tr><th>Price</th><td>{{ 'Rp ' . number_format($catalogue->price, 0, ',', '.') }}</td></tr>
    <tr><th>Status</th><td>{{ $catalogue->status_publish }}</td></tr>
    <tr><th>Image</th><td>
      @if($catalogue->image)
        <img src="{{ asset('storage/catalogue/' . $catalogue->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
      @else
        No Image
      @endif
    </td></tr>
    <tr><th>Created At</th><td>{{ \Carbon\Carbon::parse($catalogue->created_at)->translatedFormat('d F Y H:i') }}</td></tr>
    <tr><th>Updated At</th><td>{{ \Carbon\Carbon::parse($catalogue->updated_at)->translatedFormat('d F Y H:i') }}</td></tr>
  </table>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
