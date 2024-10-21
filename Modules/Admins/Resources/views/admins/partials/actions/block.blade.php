@if(auth()->user()->hasPermission('block_admins') && auth()->user()->isNot($admin))
    @if (!$admin->blocked_at)
        <a href="#admin-{{ $admin->id }}-block-model"
           class="btn btn-light waves-effect waves-light"
           data-toggle="modal">
            <i class="fa fa-ban"></i>
            @lang('admins::admins.actions.block')
        </a>


        <!-- Modal -->
        <div class="modal fade" id="admin-{{ $admin->id }}-block-model" tabindex="-1" role="dialog"
             aria-labelledby="modal-title-{{ $admin->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="modal-title-{{ $admin->id }}">@lang('admins::admins.dialogs.block.title')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('admins::admins.dialogs.block.info')
                    </div>
                    <div class="modal-footer">
                        {{ BsForm::patch(route('dashboard.admins.block', $admin)) }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            @lang('admins::admins.dialogs.block.cancel')
                        </button>
                        <button type="submit" class="btn btn-danger">
                            @lang('admins::admins.dialogs.block.confirm')
                        </button>
                        {{ BsForm::close() }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <a href="#admin-{{ $admin->id }}-unblock-model"
           class="btn btn-light waves-effect waves-light"
           data-toggle="modal">
            <i class="fa fa-check"></i>
            @lang('admins::admins.actions.unblock')
        </a>


        <!-- Modal -->
        <div class="modal fade" id="admin-{{ $admin->id }}-unblock-model" tabindex="-1" role="dialog"
             aria-labelledby="modal-title-{{ $admin->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="modal-title-{{ $admin->id }}">@lang('admins::admins.dialogs.unblock.title')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('admins::admins.dialogs.unblock.info')
                    </div>
                    <div class="modal-footer">
                        {{ BsForm::patch(route('dashboard.admins.unblock', $admin)) }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            @lang('admins::admins.dialogs.unblock.cancel')
                        </button>
                        <button type="submit" class="btn btn-danger">
                            @lang('admins::admins.dialogs.unblock.confirm')
                        </button>
                        {{ BsForm::close() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
