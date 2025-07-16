@extends('layout')

@section('content')

<header class="students-header py-3 border-bottom border-2">
    <div class="container">
        <h4 class="fw-bold m-0"><i class="fa-solid fa-calendar-check"></i> Davomat tafsilotlari</h4>
    </div>
</header>

<main class="groups-main mt-3">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Talaba</th>
                    <th>Holat</th>
                    <th>Harakat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->student->name }}</td>
                        <td>{{ $attendance->status_text }}</td>
                        <td>
                            <button type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal-{{ $attendance->id }}"
                                    class="bg-primary text-white border border-1 p-2 rounded-1">
                                O'zgartirish
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal-{{ $attendance->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Davomatni tahrirlash</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('sessions.attendance.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="session_id" value="{{ $attendance->session_id }}">
                                        <input type="hidden" name="student_id" value="{{ $attendance->student_id }}">

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Holat</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="present" {{ $attendance->status == "present" ? "selected" : "" }}>Keldi</option>
                                                <option value="absent" {{ $attendance->status == "absent" ? "selected" : "" }}>Kelmadi</option>
                                                <option value="late" {{ $attendance->status == "late" ? "selected" : "" }}>Kechqoldi</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="bg-success text-white border border-1 p-2 rounded-1">Saqlash</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection
