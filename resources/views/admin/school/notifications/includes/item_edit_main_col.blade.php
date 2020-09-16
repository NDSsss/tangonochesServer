@php
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
                            <label for="title">Заголовок</label>
                            <input name="title" value="{{ $item->title }}"
                                   id="title"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="prev_text">Превью</label>
                            <input name="prev_text" value="{{ $item->prev_text }}"
                                   id="prev_text"
                                   type="text"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="text">Основной текст</label>
                            <textarea name="text"
                                   id="text"
                                   class="form-control"
                                   required>{{$item->text}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label name="platform" for="platform">Платформа</label>
                            <select id="platform" class="form-control" name="platform" required>
                                @if($item->platform === 'all')
                                    <option value="all" selected>Все платформы</option>
                                @else
                                    <option value="all">Все платформы</option>
                                @endif
                                @if($item->platform === 'android')
                                    <option value="android" selected>Android</option>
                                @else
                                    <option value="android">Android</option>
                                @endif
                                @if($item->platform === 'ios')
                                    <option value="ios" selected>IOS</option>
                                @else
                                    <option value="ios">IOS</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="date">Дата</label>
                            <input name="date" value="{{ date('Y-m-d\TH:i', strtotime($item->date)) }}"
                                   id="date"
                                   type="datetime-local"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
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
