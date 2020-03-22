@php
    /** @var \App\Models\Group $item */
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
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input name="name" value="{{ $item->name }}"
                                   id="name"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>
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
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="first_lesson_time">Первый урок</label>
                            <input name="first_lesson_time" value="{{ $item->first_lesson_time }}"
                                   id="first_lesson_time"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="first_lesson_time_formatted">Первый урок</label>
                            <input name="first_lesson_time_formatted" value="{{date_format(date_create($item->first_lesson_time),'l H-i')}}"
                                   id="first_lesson_time_formatted"
                                   type="text"
                                   :disabled="1"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="second_lesson_time">Второй урок</label>
                            <input name="second_lesson_time" value="{{ $item->second_lesson_time }}"
                                   id="second_lesson_time"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="second_lesson_time_formatted">Второй урок</label>
                            <input name="second_lesson_time_formatted" value="{{date_format(date_create($item->second_lesson_time),'l H-i')}}"
                                   id="second_lesson_time_formatted"
                                   type="text"
                                   :disabled="1"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="address">Адресс</label>
                            <input name="address" value="{{ $item->address }}"
                                   id="address"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
