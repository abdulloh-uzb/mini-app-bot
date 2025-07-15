@extends("layout")

@section('content')
    <header class="py-3 home-header">
        <div class="container">
            <div class="header-top d-flex gap-2">
                <div class="profile-img">
                    <img src="{{asset('images/avatar.jpg')}}" alt="">
                </div>
                <div class="welcome-message">
                    <h5>☀️ Xayrli tong</h5>
                    <h5 class="fw-normal">{{auth()->user()->name}}</h5>
                </div>
            </div>
            <div class="header-bottom mt-3">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row card align-items-center">
                        <span class="fs-5 me-2">📚</span>
                        <div class="text">
                            <p class="fw-thin">Bugungi guruhlar</p>
                            <h5 class="fw-bold">{{count($todayGroups)}}</h5>
                        </div>
                    </div>
                    
                      
                    <div class="d-flex flex-row card align-items-center">
                        <span class="fs-5 me-2">
                            ✅ 
                        </span>
                        <div class="text">
                            <p class="fw-thin">Davomat qilingan</p>
                            <h5 class="fw-bold">{{$groupsAttendanceCompleted}}</h5>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </header>

    <main class="home-main">
        <div class="container mt-4">
            <div class="border-bottom pb-2 mb-3">
              <h4 class="fw-semibold mb-0">📅 Bugungi darslar</h4>
            </div>
          
            <div class="lessons">
                
                @foreach ($todayGroups as $session)
                    <?php 
                        $group = $session->group;
                        $studentsCount = $group->students->count();
                    ?>
                    <div class="lesson-card py-3 ">
                        <div class="lesson-top d-flex justify-content-between mb-3 align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary border rounded py-3 px-4 me-3">
                                        📚
                                    </div>
                                    
                                    <div>
                                        <h5 class="m-0 fw-semibold">{{$group->title}}</h5>
                                        <p>{{$session->is_attendance_completed ? "✅ Davomat olingan" : "Davomat qilinmagan"}}</p>
                                    </div>
                                </div>
                                <h3 class="text-primary fw-bold">{{$group->start_time}}</h3>
                        </div>
                        <div class="lesson-bottom d-flex justify-content-between">
                            <p>👥 {{$studentsCount}}</p>
                            <a href="{{route('sessions.attendance', $session->id)}}" class="fw-bold text-decoration-none">{{$session->is_attendance_completed ? "Ko'rish" : "Davomat olish"}}</a>
                        </div>

                    </div>
                @endforeach
            </div>
          
            <!-- Advice Box -->
            <div class="advice-box mt-3 d-flex">
              <span class="fs-4 me-3">💡</span>  
              <div>
                <h5>Maslahat</h5>
                <p>Darsdan keyin o'quvchilar bilan individual ish olib boring</p>
              </div>
              
            </div>
        </div>
    </main>
      
      

@endsection