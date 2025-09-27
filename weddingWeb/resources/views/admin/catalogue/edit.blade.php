@extends('layouts.master')
@section('content')
@push('styles')
<style>
    .preview-wrap {
        border: 1px dashed #dce0e5;
        border-radius: .75rem;
        min-height: 260px;
        /* tinggi nyaman */
        background: linear-gradient(180deg, #fafbfc, #f6f7f9);
        transition: box-shadow .2s ease, border-color .2s ease;
        overflow: hidden;
    }

    .preview-wrap:hover {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .06);
        border-color: #cfd6dd;
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush
<div class="app-content">
    <div class="container-fluid">
        <div class="card card-info card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">#{{$catalogue->id}} Edit Catalogue Package</div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="needs-validation" novalidate method="POST" action="{{ route('admin.catalogue.update', $catalogue->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    {{-- notifikasi error level atas --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row g-3">
                        {{-- user_id (opsional: isi otomatis dari auth) --}}
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        {{-- Package Name --}}
                        <div class="col-12">
                            <label for="package_name" class="form-label">Package Name</label>
                            <input type="text" class="form-control @error('package_name') is-invalid @enderror"
                                id="package_name" name="package_name" value="{{ old('package_name', $catalogue->package_name) }}"
                                placeholder="Masukkan Nama Paket" required>
                            <div class="valid-feedback">Looks good!</div>
                            @error('package_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>



                        {{-- Description --}}
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="6"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Tulis deskripsi paket..." required>{{ old('description', $catalogue->description) }}</textarea>
                            <div class="valid-feedback">Looks good!</div>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>


                        {{-- Price --}}
                        <div class="col-12">
                            <label for="price" class="form-label">Price</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">Rp</span>
                                <input type="text"
                                    class="form-control @error('price') is-invalid @enderror" id="price_format" name="price_format"
                                    value="{{ old('price', $catalogue->price) ? number_format(old('price',$catalogue->price), 0, ',', '.') : ''  }}" placeholder="0" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <input type="hidden" name="price" id="price" value="{{ old('price',$catalogue->price) }}" />
                                @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- === PREVIEW CARD ELEGAN === --}}
                        <div class="col-md-6 mt-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-3">
                                    <div class="preview-wrap position-relative">
                                        {{-- gambar tampil di sini --}}
                                        <img id="preview" alt="Preview"
                                            class="w-100 h-100 rounded object-fit-cover {{ $catalogue->image ? '' : 'd-none' }}"
                                            src="{{ $catalogue->image ? asset('storage/catalogue/' . $catalogue->image) : '' }}">

                                        {{-- placeholder saat belum ada gambar --}}
                                        <div id="preview-placeholder"
                                            class="h-100 w-100 d-flex flex-column align-items-center justify-content-center text-center text-muted {{ $catalogue->image ? 'd-none' : '' }}">
                                            <div class="mb-2">
                                                <i class="bi bi-image" style="font-size: 2.25rem;"></i>
                                            </div>
                                            <div class="fw-semibold">Belum ada gambar</div>
                                            <small class="mb-3">Pilih gambar untuk melihat pratinjau</small>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                id="btn-trigger-file">
                                                Pilih / Ganti Gambar
                                            </button>
                                        </div>

                                        {{-- action bar saat gambar sudah ada --}}
                                        <div id="preview-actions" class="position-absolute top-0 end-0 m-2 {{ $catalogue->image ? '' : 'd-none' }}">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    id="btn-change">Ganti</button>
                                                {{-- <button type="button" class="btn btn-danger btn-sm"
                                                    id="btn-clear">Hapus</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <small id="preview-meta" class="text-muted {{ $catalogue->image ? '' : 'd-none' }}">{{ $catalogue->image ? 'Gambar saat ini' : '' }}</small>
                                </div>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="col-12 ">
                            <label for="image" class="form-label">Image (max : 2mb)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image">
                            {{-- <div class="valid-feedback">Looks good!</div> --}}
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Status Publish (enum: Y/N) --}}
                        <div class="col-12">
                            <label for="status_publish" class="form-label">Publish?</label>
                            <select id="status_publish" name="status_publish"
                                class="form-select @error('status_publish') is-invalid @enderror" required>
                                <option value="" disabled {{ old('status_publish')===null ? 'selected':'' }}>Pilih
                                    status</option>
                                <option value="Y" {{ old('status_publish', $catalogue->status_publish)==='Y' ? 'selected':'' }}>Ya (Publish)
                                </option>
                                <option value="N" {{ old('status_publish', $catalogue->status_publish)==='N' ? 'selected':'' }}>Tidak (Draft)
                                </option>
                            </select>
                            @error('status_publish') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>


                    </div>
                </div>

                <div class="card-footer d-flex gap-2">
                    <a href="{{ route('admin.catalogue.index') }}" class="btn btn-light">Batal</a>
                    <button class="btn btn-info" type="submit">Simpan</button>
                </div>
            </form>

            {{-- script validasi + preview gambar --}}
            <script>
                (() => {
                    'use strict';
                    const forms = document.querySelectorAll('.needs-validation');
                    Array.from(forms).forEach(form => {
                        form.addEventListener('submit', e => {
                            if (!form.checkValidity()) {
                                e.preventDefault();
                                e.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });

                    const inputImage = document.getElementById('image');
                    const preview = document.getElementById('preview');
                    if (inputImage && preview) {
                        inputImage.addEventListener('change', (e) => {
                            const [file] = e.target.files || [];
                            if (file) {
                                preview.src = URL.createObjectURL(file);
                                preview.classList.remove('d-none');
                            } else {
                                preview.src = '';
                                preview.classList.add('d-none');
                            }
                        });
                    }
                })();

            </script>

            <!--end::JavaScript-->
        </div>
        <!--end::Form Validation-->

    </div>
</div>
@push('scripts')
<script>
    function formatRupiah(angka) {
        return angka.replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    document.addEventListener('DOMContentLoaded', function () {
        const inputFormatted = document.getElementById('price_format');
        const inputHidden = document.getElementById('price');

        inputFormatted.addEventListener('input', function () {
            let clean = this.value.replace(/\D/g, "");
            this.value = formatRupiah(clean);
            inputHidden.value = clean;
        });
    });

    (function(){
    const input   = document.getElementById('image');           // input file yang sudah ada di form
    const img     = document.getElementById('preview');
    const ph      = document.getElementById('preview-placeholder');
    const actions = document.getElementById('preview-actions');
    const meta    = document.getElementById('preview-meta');
    const btnPick = document.getElementById('btn-trigger-file');
    const btnChg  = document.getElementById('btn-change');
    const btnClr  = document.getElementById('btn-clear');

    function humanSize(bytes){
        if(!bytes && bytes !== 0) return '';
        const u=['B','KB','MB','GB']; let i=0; let n=bytes;
        while(n>=1024 && i<u.length-1){ n/=1024; i++; }
        return `${n.toFixed(n<10?1:0)} ${u[i]}`;
    }

    function showPreview(file){
        if(!file) return;
        img.src = URL.createObjectURL(file);
        img.classList.remove('d-none');
        ph.classList.add('d-none');
        actions.classList.remove('d-none');
        meta.classList.remove('d-none');
        meta.textContent = `${file.name} • ${humanSize(file.size)}`;
    }

    function clearPreview(){
        img.src = '';
        img.classList.add('d-none');
        ph.classList.remove('d-none');
        actions.classList.add('d-none');
        meta.classList.add('d-none');
        meta.textContent = '';
        if(input) input.value = ''; // kosongkan file input
    }

    // trigger pilih file
    [btnPick, btnChg].forEach(btn => btn?.addEventListener('click', () => input?.click()));
    btnClr?.addEventListener('click', clearPreview);

    // update ketika file dipilih
    input?.addEventListener('change', (e)=>{
        const file = e.target.files?.[0];
        if(file){ showPreview(file); }
        else{ clearPreview(); }
    });

    // jika halaman di-reload dengan file lama (jarang), tetap aman
    })();
</script>
@endpush
@endsection
