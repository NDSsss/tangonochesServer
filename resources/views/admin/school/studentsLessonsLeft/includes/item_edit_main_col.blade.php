@php
    /** @var \App\Models\Teacher $item */
    /** @var \Illuminate\Support\Collection $allTeachers */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                    </li>
                </ul>
                <br>

                <div class="tab-content">
                    <div class="form-group">
                        <label for="student_id">Ученик</label>
                        <select name="student_id"
                                id="student_id"
                                class="form-control"
                                required>
                            @foreach($allStudents as $currentItem)
                                <option value="{{ $currentItem->id }}"
                                        @if($currentItem->id == $item->student_id) selected @endif>
                                    {{ $currentItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="tab-content">
                        <div class="form-group">
                            <label for="ticket_event_type_id">Тип</label>
                            <select name="ticket_event_type_id"
                                    id="ticket_event_type_id"
                                    class="form-control"
                                    required>
                                @foreach($allEventTypes as $currentItem)
                                    <option value="{{ $currentItem->id }}"
                                            @if($currentItem->id == $item->ticket_event_type_id) selected @endif>
                                        {{ $currentItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="lessons_left">Осталось уроков</label>
                            <input name="lessons_left" value="{{$item->lessons_left}}"
                                   id="lessons_left"
                                   type="number"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
