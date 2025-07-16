<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://telegram.org/js/telegram-web-app.js?58"></script>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="main-content bg-white">
        @yield('content')

        <footer class="d-flex mt-5">
           <?php $currentUrl = request()->segment(1);?>
           <a href="{{route('teachers.home')}}" class="btn d-flex flex-column {{$currentUrl == 'home' ? 'bg-primary text-white' : ''}}"><i class="fa-solid fa-house"></i> <span>Asosiy</span></a>
           <a href="{{route('groups.index')}}" class="btn d-flex flex-column {{$currentUrl == 'groups' ? 'bg-primary text-white' : ''}}"><i class="fa-solid fa-user-group"></i> <span>Guruhlar</span></a>
           <a href="{{route('teachers.settings')}}" class="btn d-flex flex-column {{$currentUrl == 'students' ? 'bg-primary text-white' : ''}}" ><i class="fa-solid fa-gear"></i> <span>Sozlamalar</span></a>
        </footer>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    const initData = Telegram.WebApp.initData;

    fetch('/auth/telegram', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ initData }),
        credentials: 'same-origin' 
    })
    .then(res => res.json())
    .then(data => {
        console.log('Login result:', data);
    });
</script>


</html>