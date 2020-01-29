@php
    /** @var \App\Models\Teacher $item */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(!$item->exists)
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                @endif
            </div>
        </div>
    </div>
</div><br>

