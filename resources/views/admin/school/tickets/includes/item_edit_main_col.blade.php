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
                    <div class="form-group">
                        <label for="student_id">Кому</label>
                        <select name="student_id"
                                id="student_id"
                                class="form-control"
                                placeholder="Кому"
                                required>
                            @foreach($allStudents as $currentItem)
                                <option value="{{ $currentItem->id }}"
                                        @if($currentItem->id == $item->student_id) selected @endif>
                                    {{--{{ $categoryOption->id }}. {{ $categoryOption->title }}--}}
                                    {{ $currentItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Кто</label>
                        <select name="teacher_id"
                                id="teacher_id"
                                class="form-control"
                                placeholder="Кто"
                                required>
                            @foreach($allTeachers as $currentItem)
                                <option value="{{ $currentItem->id }}"
                                        @if($currentItem->id == $item->teacher_id) selected @endif>
                                    {{--{{ $categoryOption->id }}. {{ $categoryOption->title }}--}}
                                    {{ $currentItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="ticket_bought_date">Когда</label>
                            <input name="ticket_bought_date" value="{{$item->ticket_bought_date}}"
                                   id="ticket_bought_date"
                                   type="text"
                                   :disabled="1"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="ticket_start_date">Начало</label>
                            <input name="ticket_start_date" value="{{$item->ticket_start_date}}"
                                   id="ticket_start_date"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="ticket_end_date">Конец</label>
                            <input name="ticket_end_date" value="{{$item->ticket_end_date}}"
                                   id="ticket_end_date"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="ticket_count_type_id">Количество</label>
                        <select name="ticket_count_type_id"
                                id="ticket_count_type_id"
                                class="form-control"
                                required>
                            @foreach($allCountTypes as $currentItem)
                                <option value="{{ $currentItem->id }}"
                                        @if($currentItem->id == $item->ticket_count_type_id) selected @endif>
                                    {{ $currentItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ticket_event_type_id">Тип</label>
                        <select name="ticket_event_type_id"
                                id="ticket_event_type_id"
                                class="form-control"
                                required>
                            @foreach($allEventTypes as $currentItem)
                                <option value="{{ $currentItem->id }}"
                                        @if($currentItem->id == $item->ticket_count_type_id) selected @endif>
                                    {{ $currentItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               id="is_in_pair"
                               name="is_in_pair"
                               @if($item->is_in_pair)checked="" @endif
                               value=0>
                        <label class="form-check-label"
                               for="is_in_pair">
                            Парный
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
