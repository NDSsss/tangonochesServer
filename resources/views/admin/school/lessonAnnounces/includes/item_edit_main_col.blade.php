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
                        <label for="group_id">Группа</label>
                        <select name="group_id"
                                id="group_id"
                                class="form-control"
                                required>
                            @foreach($allGroups as $currentItem)
                                <option value="{{ $currentItem->id }}"
                                        @if($currentItem->id == $item->group_id) selected @endif>
                                    {{ $currentItem->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="start_date">Начало</label>
                            <input name="start_date" value="{{ $item->start_date }}"
                                   id="start_date"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="start_date_formatted">Начало</label>
                            <input name="start_date_formatted" value="{{date_format(date_create($item->start_date),'l H-i')}}"
                                   id="start_date_formatted"
                                   type="text"
                                   :disabled="1"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="end_date">Конец</label>
                            <input name="end_date" value="{{ $item->end_date }}"
                                   id="end_date"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="send_date_formatted">Конец</label>
                            <input name="end_date_formatted" value="{{date_format(date_create($item->end_date),'l H-i')}}"
                                   id="end_date_formatted"
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
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="extra_info">Доп информация</label>
                            <input name="extra_info" value="{{ $item->extra_info }}"
                                   id="extra_info"
                                   type="text"
                                   class="form-control"
                                   minlength="3">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               id="is_active"
                               name="is_active"
                               @if($item->is_active)checked="" @endif
                               value=0>
                        <label class="form-check-label"
                               for="is_active">
                            Активный
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
