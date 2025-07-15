@extends("layout")

@section('content')

<header class="students-header py-3 border-bottom border-2">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3 align-items-center">
                <h4 class="fw-bold m-0"><i class="fa-solid fa-user-group"></i> O'quvchilar</h4>
                <p>{{count($students)}}ta </p>
            </div>

            <div class="rounded-circle border d-flex justify-content-center align-items-center border-3" style="width:50px; height:50px;">
                <span>{{count($students)}}</span>
              </div>
        </div>
    </div>
</header>

<main class="groups-main mt-3">
    <div class="container">
        <div class="status-info d-flex justify-content-between">
            <div class="info-card border border-1 d-flex align-items-center gap-2 ps-3 py-2">
                <div class="info-icon bg-success"></div>
                <div class="info-text">
                    <p>Faol</p>
                    <span class="fw-bold">0</span>
                </div>
            </div>
            <div class="info-card border border-1 d-flex align-items-center gap-2 ps-3 py-2">
                <div class="info-icon bg-danger"></div>
                <div class="info-text">
                    <p>Qarzdor</p>
                    <span class="fw-bold">20</span>
                </div>
            </div>
            <div class="info-card border border-1 d-flex align-items-center gap-2 ps-3 py-2">
                <div class="info-icon bg-secondary"></div>
                <div class="info-text">
                    <p>Umumiy qarz</p>
                    <span class="fw-bold">7M</span>
                </div>
            </div>
        </div>
        <div class="list mt-3">
            
            @foreach ($students as $student)
                <div class="border mt-3 border-2 p-3 rounded-3">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="border rounded py-2 px-3" style="background: #e3e5f4;">
                                📚
                            </div>
                            <p class="m-0 fs-6 fw-semibold"><a href="{{route('groups.show', $group->id)}}">{{$student->name}}</a></p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-danger">-250 000 uzs</p>         
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">
                            <i class="fa-solid fa-phone me-2"></i>
                            {{$student->phone_number}}
                        </p>
                        <a href="" class="text-muted">
                            <div class="info-icon bg-danger"></div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@endsection