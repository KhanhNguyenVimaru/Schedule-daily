@include('header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/8324/8324227.png">
    <title>Schedule Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<style>
    body {
        font-family: "bahnschrift";
    }

    #data-rows {
        font-weight: normal;
        font-size: 14px;
    }

    .newTask {
        width: 100%;
        height: 37px;
        border: none;
    }

    .newTask :focus {
        border: none;
        outline: none;
    }

    #add-new-rows-row td {
        padding: 0;
        padding-left: 8px;
    }

    #endTime,
    #startTime {
        height: 40px;
        width: 100%;
    }

    .hover-row {
        cursor: pointer;
    }
</style>

<body>
    <div class="container-fluid" style="width:100%; min-height:100vh; padding-right: 15%; padding-left: 15%">
        <table class = "table">
            <thead>
                <!-- <th style="width: 10%">ID</th> -->
                <th style="width: 30%">Task Name</th>
                <th style="width: 40%">Detail</th>
                <th style="width: 30%">Duration</th>
                <th style="width: 10%">Handle</th>
            </thead>
            <tbody id = "data-rows">
                @foreach ($tasks as $item)
                    <tr class = "hover-row"
                        onclick="loadRowData(
                        '{{ $item->id }}',
                        '{{ addslashes($item->name) }}',
                        '{{ addslashes($item->detail) }}',
                        '{{ $item->duration }}',
                        '{{ $item->startTime }}',
                        '{{ $item->endTime }}'
                    )">
                        <!-- <td>{{ $item->id }}</td> -->
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->detail }}</td>
                        @if ($item->duration == 'alway')
                            <td>Alway</td>
                        @else
                            <td>
                                {{ $item->startTime ? \Carbon\Carbon::parse($item->startTime)->format('d/m/Y') : '' }}
                                - {{ $item->endTime ? \Carbon\Carbon::parse($item->endTime)->format('d/m/Y') : '' }}
                            </td>
                        @endif
                        <td style="text-align: center; vertical-align: middle; padding: 0">
                            <form action="{{ route('task.delete', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:none; padding:0;">
                                    <i class="bi bi-trash" style="color: red"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr id = "add-new-rows-row">
                    <!-- <td style="vertical-align: middle;">
                        {{ isset($item->id) ? $item->id + 1 : 1 }}
                    </td> -->
                    <td><input style="padding: 0" type="text" name="name" id="name" class = "newTask"
                            id = "newTask" placeholder="Task name..."></td>
                    <td><input style="padding: 0" type="text" name="detail" id="detail" class = "newTask"
                            id = "newDetail" placeholder="Detail content..."></td>
                    <td style="text-align: start; vertical-align: middle; padding: 0; padding: 0">
                        <select id="duration-select" class="newTask" style="width: 40%; padding-left:4px; color:gray">
                            <option style="color:black" value="alway">Alway</option>
                            <option style="color:black" value="time">Time</option>
                        </select>
                        <button
                            style="font-family: 14px!important; color:gray; border:none; background-color:white; visibility:hidden">Setup</button>
                    </td>
                    <td style="text-align: center; vertical-align: middle; padding: 0" id = "insert-newtask">
                        <a href="">
                            <i class="bi bi-plus-square" style="color: blue"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- modal new tasks time setup --}}
    <div class="modal fade manage_modal modal-md" id="timeSetup" tabindex="-1" aria-labelledby="timeSetupModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Time Setup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-timesetup" style="display:flex; justify-content:center;">
                    <div style="width: 80%">

                        <div class = "hidden-timeinput" style="margin-bottom:20px">
                            <label for="startTime">Start time</label>
                            <input type="datetime-local" name="startTime" id="startTime">
                        </div>

                        <div class = "hidden-timeinput" style="margin-bottom:20px">
                            <label for="endTime">End time</label>
                            <input type="datetime-local" name="endTime" id="endTime">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id = "setTimeBtn" class = "btn btn-primary">Finish</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit/View Task -->
    <div class="modal fade" id="taskEditModal" tabindex="-1" aria-labelledby="taskEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskEditModalLabel">Task Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="taskEditForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- Các input -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="editTaskId" class="form-label">ID</label>
                                    <input type="text" class="form-control" id="editTaskId" name="editTaskId">
                                </div>
                                <div class="mb-3">
                                    <label for="editTaskName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="editTaskName" name = "name">
                                </div>
                                <div class="mb-3">
                                    <label for="editTaskDetail" class="form-label">Detail</label>
                                    <input type="text" class="form-control" id="editTaskDetail" name = "detail">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="editTaskDuration" class="form-label">Duration</label>
                                    <input type="text" class="form-control" id="editTaskDuration"
                                        name = "duration">
                                </div>
                                <div class="mb-3">
                                    <label for="editTaskStartTime" class="form-label">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="editTaskStartTime"
                                        name = "startTime">
                                </div>
                                <div class="mb-3">
                                    <label for="editTaskEndTime" class="form-label">End Time</label>
                                    <input type="datetime-local" class="form-control" id="editTaskEndTime"
                                        name = "endTime">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="updateRowData" class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const userId = {{ auth()->user()->id }};
    const durationTime = {
        duration: 'alway',
        startTime: null,
        endTime: null
    }

    // Xử lý ẩn/hiện nút Setup khi chọn option
    const durationSelect = document.getElementById('duration-select');
    const setupBtn = durationSelect.nextElementSibling;
    durationSelect.addEventListener('change', function() {
        if (this.value === 'time') {
            setupBtn.style.visibility = 'visible';
        } else {
            setupBtn.style.visibility = 'hidden';
        }
    });
    // Khi bấm Setup thì hiện modal
    setupBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const timeSetupModal = new bootstrap.Modal(document.getElementById('timeSetup'));
        timeSetupModal.show();
    });

    document.getElementById('setTimeBtn').addEventListener('click', function() {
        durationTime.startTime = document.getElementById('startTime')?.value ?? null;
        durationTime.endTime = document.getElementById('endTime')?.value ?? null;

        if (!durationTime.startTime || !durationTime.endTime) {
            alert('Please enter both start time and end time!');
            return;
        }

        // duration chỉ là 'time' nếu chọn time, không xác định long-term/short-term ở JS nữa
        durationTime.duration = 'time';

        // Đóng modal
        const timeSetupModal = document.getElementById('timeSetup');
        const modal = bootstrap.Modal.getInstance(timeSetupModal);
        modal.hide();
    });

    document.getElementById('insert-newtask')?.addEventListener('click', function(e) {
        e.preventDefault();
        const newTask = {
            name: document.getElementById('name').value,
            detail: document.getElementById('detail').value,
            duration: durationTime.duration,
            startTime: durationTime.startTime,
            endTime: durationTime.endTime
        };

        fetch(`/newTask`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(newTask)
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/taskPage';
                } else {
                    return response.json().then(data => {
                        throw data;
                    });
                }
            })
            .catch(error => {
                alert('Failed to add task!');
                console.error(error);
            });
    });

    function loadRowData(id, name, detail, duration, startTime, endTime) {
        document.getElementById('editTaskId').value = id || '';
        document.getElementById('editTaskName').value = name || '';
        document.getElementById('editTaskDetail').value = detail || '';
        document.getElementById('editTaskDuration').value = duration || '';

        // Định dạng cho input datetime-local
        function toDatetimeLocal(val) {
            if (!val) return '';
            const date = new Date(val);
            // Lấy offset timezone để đúng giờ local
            const tzOffset = date.getTimezoneOffset() * 60000;
            const localISOTime = new Date(date - tzOffset).toISOString().slice(0, 16);
            return localISOTime;
        }

        document.getElementById('editTaskStartTime').value = toDatetimeLocal(startTime);
        document.getElementById('editTaskEndTime').value = toDatetimeLocal(endTime);

        // Set action cho form update
        document.getElementById('taskEditForm').action = '/update/' + id;

        const modal = new bootstrap.Modal(document.getElementById('taskEditModal'));

        setTimeout(() => {
            modal.show();
        }, 400);
    }
</script>

</html>
