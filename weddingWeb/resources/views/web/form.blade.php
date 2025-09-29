@extends('web.layouts.master')

@push('web-styles')
<style>
    .form-section {
        background: #fff;
        padding: 2rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin: 1rem 0;
    }
    .form-section h5 { color: var(--brand); margin-bottom: 0.5rem; }
    .form-section p { margin-bottom: 0; color: #666; }
    .btn-submit {
        background: var(--brand);
        color: #fff;
        border: none;
        padding: 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        width: 100%;
    }
    .btn-submit:hover { background: var(--brand-100); color:#fff; }
    .input-group .btn-outline-secondary { border-left: none; }
</style>
@endpush

@section('web-content')
<section class="py-5" style="margin-top: 100px;">
    <div class="container">
        <h1 class="text-center mb-2">Form Pesan</h1>

        {{-- Tampilkan error server-side (jika ada) --}}
        
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-lg-8">
                <form id="orderForm" method="POST" action="{{ route('user.order.store') }}" novalidate>
                    @csrf
                    <input type="hidden" name="catalogue_id" value="{{ $catalogue->id }}">

                    <!-- Tanggal -->
                    <div class="form-section mb-1">
                        <label for="tanggal" class="form-label">Tanggal Acara <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            class="form-control @error('wedding_date') is-invalid @enderror"
                            id="tanggal"
                            name="wedding_date"
                            value="{{ old('wedding_date') }}"
                            min="{{ now()->toDateString() }}"
                            required>
                        <div class="valid-feedback">
                            Looks is good
                        </div>
                        <div class="invalid-feedback">
                            Tanggal acara wajib diisi dan tidak boleh kurang dari hari ini.
                        </div>
                    </div>

                    <!-- Nama & Email -->
                    <div class="form-section mb-1">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Perwakilan Nama <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="nama"
                                    placeholder="Masukkan nama lengkap"
                                    name="name"
                                    value="{{ old('name', Auth::user()->name ?? '') }}"
                                    required>
                                <button class="btn btn-outline-secondary" type="button" id="clearNama" aria-label="Kosongkan nama">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="valid-feedback">
                                    Looks is good
                                </div>
                                <div class="invalid-feedback">
                                    Nama wajib diisi.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Aktif <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="Masukkan email"
                                    name="email"
                                    value="{{ old('email', Auth::user()->email ?? '') }}"
                                    required>
                                <button class="btn btn-outline-secondary" type="button" id="clearEmail" aria-label="Kosongkan email">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="valid-feedback">
                                    Looks is good
                                </div>
                                <div class="invalid-feedback">
                                    Email tidak valid atau belum diisi.
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="phone_number" class="form-label">Nomor Telepon Aktif <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input
                                    type="string"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number"
                                    placeholder="Masukkan nomor"
                                    name="phone_number"
                                    value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}"
                                    required>
                                <button class="btn btn-outline-secondary" type="button" id="clearNomor" aria-label="Kosongkan nomor telepon">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="valid-feedback">
                                    Looks is good
                                </div>
                                <div class="invalid-feedback">
                                    Nomor tidak valid atau belum diisi.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Paket -->
                    <div class="form-section mb-1">
                        <h3 class="text-center mt-3">Paket</h3>
                        <div class="border p-3 rounded">
                            <h5 class="text-capitalize mb-1">Paket {{ $catalogue->package_name }}</h5>
                            <p class="mb-1">{{ 'Rp ' . number_format($catalogue->price, 0, ',', '.') }}</p>
                            <p class="mb-0">{{ ucfirst(strtolower($catalogue->description)) }}</p>
                        </div>
                    </div>

                    <!-- Setuju S&K -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="setuju" name="agree_terms" required>
                        <label class="form-check-label" for="setuju">
                            Saya setuju dengan syarat dan ketentuan
                        </label>
                        <div class="invalid-feedback d-block" id="termsFeedback" style="display:none;">
                            Harus centang ini untuk melanjutkan.
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="submitBtn" class="btn btn-submit" disabled>Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('web-scripts')
<script>
(function() {
    const form = document.getElementById('orderForm');
    const checkbox = document.getElementById('setuju');
    const termsFeedback = document.getElementById('termsFeedback');
    const submitBtn = document.getElementById('submitBtn');

    // Tombol clear
    document.getElementById('clearNama').addEventListener('click', () => {
        document.getElementById('nama').value = '';
        document.getElementById('nama').focus();
    });
    document.getElementById('clearEmail').addEventListener('click', () => {
        document.getElementById('email').value = '';
        document.getElementById('email').focus();
    });
    document.getElementById('clearNomor').addEventListener('click', () => {
        document.getElementById('phone_number').value = '';
        document.getElementById('phone_number').focus();
    });

    // Enable/disable tombol submit sesuai checkbox
    const toggleSubmit = () => {
        submitBtn.disabled = !checkbox.checked;
        if (checkbox.checked) {
            checkbox.setCustomValidity('');
            termsFeedback.style.display = 'none';
        }
    };
    checkbox.addEventListener('change', toggleSubmit);
    toggleSubmit(); // initial

    // Validasi saat submit
    form.addEventListener('submit', function(e) {
        // Bootstrap style
        form.classList.add('was-validated');

        // Custom validasi checkbox
        if (!checkbox.checked) {
            e.preventDefault();
            e.stopPropagation();

            // Set custom validity + tampilkan pesan
            checkbox.setCustomValidity('Harus centang ini');
            termsFeedback.style.display = 'block';

            // Fokus & scroll ke checkbox
            checkbox.focus({ preventScroll: true });
            checkbox.scrollIntoView({ behavior: 'smooth', block: 'center' });

            return false;
        } else {
            checkbox.setCustomValidity('');
            termsFeedback.style.display = 'none';
        }

        // Jika field lain invalid (HTML5)
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            // Scroll ke field pertama yang invalid
            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                firstInvalid.focus({ preventScroll: true });
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return false;
        }
    }, false);
})();
</script>
@endpush
