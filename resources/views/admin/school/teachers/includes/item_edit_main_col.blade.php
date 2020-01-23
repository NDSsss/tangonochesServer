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
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input name="name" value="{{ $item->name }}"
                                   id="name"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="default_teacher_id">Выберете преподователя, с кем обычно ведет уроки</label>
                        <select name="default_teacher_id"
                                id="default_teacher_id"
                                class="form-control"
                                placeholder="Выберете преподователя, с кем обычно ведет уроки"
                                required>
                            @foreach($allTeachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                        @if($teacher->id == $item->default_teacher_id) selected @endif>
                                    {{--{{ $categoryOption->id }}. {{ $categoryOption->title }}--}}
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
