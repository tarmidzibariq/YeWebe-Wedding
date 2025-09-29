@extends('web.layouts.master')
@push('web-styles')
    <style>
        .main-img-wrapper {
            width: 100%;
            height: 500px;
            /* Ukuran konsisten */
            overflow: hidden;
            border-radius: 8px;
        }

        .main-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Gambar tidak dipotong */
            object-position: center;
        }

    </style>
@endpush
@section('web-content')
<section id="detail-mobil" style="margin-top: 100px;">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Gambar Mobil -->
            <div class="col-lg-6">
                <!-- Wrapper gambar utama -->
                <div class="main-img-wrapper mb-3">
                    <img id="mainImage" src="{{  $catalogue->image && Storage::disk('public')->exists('catalogue/' . $catalogue->image)
                            ? asset('storage/catalogue/' . $catalogue->image)
                            : asset('asset/NoImage.png') }}" alt="{{$catalogue->package_name}} yewebe wedding"
                        class="main-img" data-bs-toggle="modal" data-bs-target="#zoomModal" alt="Mobil"
                        style="cursor: zoom-in;">
                </div>
            </div>
            <!-- Modal Zoom -->
            <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-body text-center p-0">
                            <img id="zoomImage" src="{{  $catalogue->image && Storage::disk('public')->exists('catalogue/' . $catalogue->image)
                            ? asset('storage/catalogue/' . $catalogue->image)
                            : asset('asset/NoImage.png') }}" alt="{{$catalogue->package_name}} yewebe wedding" class="img-fluid w-100"
                                alt="Zoom Preview">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Mobil -->
            <div class="col-lg-6">
                <h2 class="fw-bold text-capitalize">
                    {{$catalogue->package_name}}
                </h2>
                <p class="mt-3 fw-light" style="font-size: 20px;">
                    {{$catalogue->description}}
                </p>
                <h2 class="fw-bold">{{'Rp '.number_format($catalogue->price, 0, ',', '.')}}</h2>


                <div class="py-2">
                    <p class="fw-medium mb-0">Opsional (Tambahan Biaya):</p>
                    <ul class="text-capitalize">
                        <li>Penambahan 50 pax catering: Rp 3.500.000,-</li>
                        <li>Drone untuk dokumentasi: Rp 2.000.000,-</li>
                        <li>Live music akustik: Rp 5.000.000,-</li>
                    </ul>
                </div>

                <!-- Tombol -->
                <div class="d-flex align-items-center gap-3 mt-3">

                    {{-- <a href="" class="btn btn-primary fw-semibold px-5 py-2" style="background-color: var(--primary);">
                        <span style="color: var(--yellow);">DP Sekarang</span><br>
                        <small class="fw-normal text-white" style="font-size: 12px;">Min: Rp 500.000</small>
                    </a> --}}
                    <a href="{{route('login')}}" class="btn btn-outline-primary fw-semibold px-5 py-2">
                        <span>Login untuk Pesan</span><br>
                        <small class="fw-normal text-muted" style="font-size: 12px;">Akses fitur hanya untuk
                            pengguna
                            terdaftar</small>
                    </a>
                    <button class="btn btn-outline-secondary rounded-circle" style="width: 45px; height: 45px;"
                        onclick="shareLink()" title="Bagikan">
                        <i class="fas fa-share-alt"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('web-scripts')
    <script>
        function switchImage(el) {
            const main = document.getElementById("mainImage");
            const zoom = document.getElementById("zoomImage");

            // Set gambar utama
            main.src = el.src;

            // Set gambar zoom juga
            zoom.src = el.src;

            // Highlight aktif
            document.querySelectorAll(".thumb-img").forEach(img => img.classList.remove("active"));
            el.classList.add("active");
        }
        
        function shareLink() {
            const currentUrl = "{{ url()->current() }}";

            if (navigator.share) {
                navigator.share({
                    title: 'Lihat Mobil Ini',
                    text: 'Cek mobil ini yuk!',
                    url: currentUrl
                }).then(() => {
                    console.log("Berhasil dibagikan");
                }).catch((err) => {
                    console.warn("Gagal membagikan:", err);
                });
            } else {
                // Fallback untuk browser lama: copy to clipboard
                navigator.clipboard.writeText(currentUrl).then(() => {
                    alert("Link berhasil disalin ke clipboard!");
                }).catch((err) => {
                    alert("Gagal menyalin link: " + err);
                });
            }
        }
    </script>
@endpush