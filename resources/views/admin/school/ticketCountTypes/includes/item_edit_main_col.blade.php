@php
    /** @var \App\Models\Teacher $item */
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
                            <label for="price">Цена</label>
                            <input name="price" value="{{ $item->price }}"
                                   id="price"
                                   type="number"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="lessons_count">Количество посещений</label>
                            <input name="lessons_count" value="{{ $item->lessons_count }}"
                                   id="lessons_count"
                                   type="number"
                                   class="form-control"
                                   required>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
