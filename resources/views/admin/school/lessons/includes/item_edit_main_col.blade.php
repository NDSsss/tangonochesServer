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
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="group_id">Группа</label>
                            <input name="group_id" value="{{ $item->group_id }}"
                                   id="first_lesson_time"
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
