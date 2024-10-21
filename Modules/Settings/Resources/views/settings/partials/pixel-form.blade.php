@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="accordion" id="accordionExample">

    <div class="card">

        <div class="card-body">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">@lang('settings::settings.attributes.facebook_pixel')</label>
                        <textarea type="text" name="facebook_pixel" class="form-control" rows="3"> {{ Settings::get('facebook_pixel') }} </textarea>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">@lang('settings::settings.attributes.snapchat_pixel')</label>
                        <textarea type="text" name="snapchat_pixel" class="form-control" rows="3"> {{ Settings::get('snapchat_pixel') }} </textarea>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">@lang('settings::settings.attributes.tiktok_pixel')</label>
                        <textarea type="text" name="tiktok_pixel" class="form-control" rows="3"> {{ Settings::get('tiktok_pixel') }} </textarea>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">@lang('settings::settings.attributes.google_ads_pixel')</label>
                        <textarea type="text" name="google_ads_pixel" class="form-control" rows="3"> {{ Settings::get('google_ads_pixel') }} </textarea>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">@lang('settings::settings.attributes.google_analytics')</label>
                        <textarea type="text" name="google_analytics" class="form-control" rows="3"> {{ Settings::get('google_analytics') }} </textarea>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">@lang('settings::settings.attributes.google_tag_manager_pixel')</label>
                        <textarea type="text" name="google_tag_manager_pixel" class="form-control" rows="3"> {{ Settings::get('google_tag_manager_pixel') }} </textarea>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">@lang('settings::settings.attributes.clearity')</label>
                        <textarea type="text" name="clearity" class="form-control" rows="3"> {{ Settings::get('clearity') }} </textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
