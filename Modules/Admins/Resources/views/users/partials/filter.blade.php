{{ BsForm::resource('admins::users')->get(url()->current()) }}
@component('dashboard::layouts.components.accordion')
    @slot('title', trans('admins::user.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('name')->value(request('name'))->label(trans('admins::user.attributes.name')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('email')->value(request('email'))->label(trans('admins::user.attributes.email')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('phone')->value(request('phone'))->label(trans('admins::user.attributes.phone')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('admins::user.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('admins::user.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
