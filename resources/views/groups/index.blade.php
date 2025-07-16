@extends("layout")

@section('content')

<header class="students-header py-3 border-bottom border-2">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3 align-items-center">
                <h4 class="fw-bold m-0"><i class="fa-solid fa-user-group"></i> Guruhlar</h4>
                <p>{{count($groups)}}ta guruh</p>
            </div>

            <div class="rounded-circle border d-flex justify-content-center align-items-center border-3" style="width:50px; height:50px;">
                <span>{{count($groups)}}</span>
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
                    <p>Aktiv</p>
                    <span class="fw-bold">{{ $activeCount }}</span>
                </div>
            </div>
            <div class="info-card border border-1 d-flex align-items-center gap-2 ps-3 py-2">
                <div class="info-icon bg-primary"></div>
                <div class="info-text">
                    <p>Demo</p>
                    <span class="fw-bold">{{ $inactiveCount }}</span>
                </div>
            </div>
            <div class="info-card border border-1 d-flex align-items-center gap-2 ps-3 py-2">
                <div class="info-icon bg-secondary"></div>
                <div class="info-text">
                    <p>Tugagan</p>
                    <span class="fw-bold">{{ $demoCount }}</span>
                </div>
            </div>
        </div>
        <div class="list mt-3">
            
            @foreach ($groups as $group)
                <?php $studentsCount = $group->students->count();?>
                <div class="border mt-3 border-2 p-3 rounded-3">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="border rounded py-2 px-3" style="background: #e3e5f4;">
                                📚
                            </div>
                            <h5 class="m-0 fs-5 fw-semibold"><a href="{{route('groups.show', $group->id)}}" style="text-decoration:none;" class="text-muted">{{$group->title}}</a></h5>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="info-icon bg-success"></div>
                            Aktiv         
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">
                            <i class="fa-solid fa-users"></i>
                            {{$studentsCount}} o'quvchi
                        </p>
                        <a href="{{route('groups.show', $group->id)}}" class="text-muted">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@endsection