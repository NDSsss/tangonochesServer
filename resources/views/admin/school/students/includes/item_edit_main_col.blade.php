@php
    /** @var \App\Models\Student $item */
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

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="phone">Имя</label>
                            <input name="phone" value="{{ $item->phone }}"
                                   id="phone"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="vk_profile_link">vk_profile_link</label>
                            <input name="vk_profile_link" value="{{ $item->vk_profile_link }}"
                                   id="vk_profile_link"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="vk_profile_id">vk_profile_id</label>
                            <input name="vk_profile_id" value="{{ $item->vk_profile_id }}"
                                   id="vk_profile_id"
                                   type="number"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="facebook_profile_link">facebook_profile_link</label>
                            <input name="facebook_profile_link" value="{{ $item->facebook_profile_link }}"
                                   id="facebook_profile_link"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="facebook_profile_id">facebook_profile_id</label>
                            <input name="facebook_profile_id" value="{{ $item->facebook_profile_id }}"
                                   id="facebook_profile_id"
                                   type="number"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="instagram_profile_link">instagram_profile_link</label>
                            <input name="instagram_profile_link" value="{{ $item->instagram_profile_link }}"
                                   id="instagram_profile_link"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="instagram_profile_id">instagram_profile_id</label>
                            <input name="instagram_profile_id" value="{{ $item->instagram_profile_id }}"
                                   id="instagram_profile_id"
                                   type="number"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="photo_link">photo_link</label>
                            <input name="photo_link" value="{{ $item->photo_link }}"
                                   id="photo_link"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="extra_info">extra_info</label>
                            <input name="extra_info" value="{{ $item->extra_info }}"
                                   id="extra_info"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="push_token">push_token</label>
                            <input name="push_token" value="{{ $item->push_token }}"
                                   id="push_token"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="barcode_id">barcode_id</label>
                            <input name="barcode_id" value="{{ $item->barcode_id }}"
                                   id="barcode_id"
                                   type="number"
                                   class="form-control">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
