@extends('layout')

@section('content')


<h1>Attendance Details</h1>

<table class="table">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->student->name }}</td>
                <td>{{ $attendance->status_text }}</td>
                <td>
                    <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal-{{$attendance->id}}" class="bg-primary text-white border border-1 p-2 rounded-1" style="text-decoration:none;" href="#">O'zgartirish</button>
                </td>
            </tr>
            <div class="modal fade" id="exampleModal-{{$attendance->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <form action="{{route('sessions.attendance.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$attendance->session_id}}">
                            <input type="hidden" name="student_id" value="{{$attendance->student_id}}">

                            <select name="status" id="status" class="form-control">
                                <option {{$attendance->status == "present" ? "selected" : ""}}  value="present">Keldi</option>
                                <option {{$attendance->status == "absent" ? "selected" : ""}}  value="absent">Kelmadi</option>
                                <option {{$attendance->status == "late" ? "selected" : ""}}  value="late">Kechqoldi</option>
                            </select>
                            <button type="submit" class="bg-success text-white border border-1 p-2 rounded-1" style="text-decoration:none;">Saqlash</button>
                        </form>
                    </div>

                </div>
                </div>
            </div>
          
        @endforeach
    </tbody>
</table>
@endsection