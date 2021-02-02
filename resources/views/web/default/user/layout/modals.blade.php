<div id="ImageModal" class="modal fade modal-dialog-s" role="dialog">
    <div class="modal-dialog modal-dialog-s">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close mart-s-10" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>
                    <img src="#" class="img-responsive" style="max-width: 100%"/>
                </p>
            </div>
        </div>

    </div>
</div>

<div id="VideoModal" class="modal fade modal-dialog-s" role="dialog">
    <div class="modal-dialog modal-dialog-s">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close mart-s-10" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>
                    <video width="570" controls>
                        <source src="#" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </p>
            </div>
        </div>

    </div>
</div>

<div class="modal fade modal-dialog-s" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-s">
        <div class="modal-content">
            <div class="modal-header">
                {{ trans('main.alert') }}
            </div>
            <div class="modal-body">
                {{ trans('main.are_you_sure') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('main.cancel') }}</button>
                <a class="btn btn-danger btn-ok">{{ trans('main.yes_sure') }}</a>
            </div>
        </div>
    </div>
</div>
