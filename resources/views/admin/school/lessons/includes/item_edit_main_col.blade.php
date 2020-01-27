@php
    /** @var \App\Models\Group $item */
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
                                placeholder="Группа"
                                required>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}"
                                        @if($group->id == $item->group_id) selected @endif>
                                    {{ $group->id }}. {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="tab-pane active">
                        <label>Преподователи</label>
                        @foreach($teachers as $teacher)
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="{{"present_students_$teacher->id"}}"
                                       name="present_teachers[]"
                                       @if($teacher->selected)checked=""@endif
                                       value="{{$teacher->id}}">
                                <label class="form-check-label"
                                       for="{{"present_teachers_$teacher->id"}}">
                                    {{$teacher->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="tab-pane active">
                        <label>Ученики</label>
                        @foreach($students as $student)
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="{{"present_students_$student->id"}}"
                                       name="present_students[]"
                                       @if($student->selected)checked=""@endif
                                       value="{{$student->id}}">
                                <label class="form-check-label"
                                       for="{{"present_students_$student->id"}}">
                                    {{$student->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
