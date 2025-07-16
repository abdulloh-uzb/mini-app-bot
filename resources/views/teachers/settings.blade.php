@extends('layout')

@section('content')

<header class="py-3 border-bottom border-2">
    <div class="container">
        <h5 class="fw-bold m-0"><i class="fa-solid fa-user-gear"></i> Profil</h5>
    </div>
</header>

<main class="mt-3">
    <div class="container">

            <div class="d-flex flex-column gap-3">
                <div class="p-3 bg-white shadow-sm rounded-4">
                    <label class="text-muted small mb-1">Ism</label>
                    <input type="text" class="form-control border-0 p-2" value="Abdulloh Usmonov" />
                </div>

                <div class="p-3 bg-white shadow-sm rounded-4">
                    <label class="text-muted small mb-1">Email</label>
                    <input type="email" class="form-control border-0 p-2" value="abdulloh@example.com" />
                </div>

                <div class="p-3 bg-white shadow-sm rounded-4 d-flex justify-content-between align-items-center">
                    <div>
                        <label class="text-muted small">Qorong'u rejim</label>
                        <div class="fw-semibold">Yoqilgan</div>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                </div>

                <div class="p-3 bg-white shadow-sm rounded-4 d-flex justify-content-between align-items-center">
                    <div>
                        <label class="text-muted small">Eslatmalar</label>
                        <div class="fw-semibold">O'chirilgan</div>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </div>

                <button class="bg-primary text-white border border-1 p-2 rounded-1">Saqlash</button>
            </div>
    </div>
</main>

@endsection
