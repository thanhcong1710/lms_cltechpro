@extends('admin.newlayout.layout',['breadcom'=>['Courses','Edit',$item->title]])
@section('title')
    {{ trans('admin.edit_course') }}
@endsection
@section('page')

    <div class="card">
        <div class="card-body">
            <div class="tabs">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#main" data-toggle="tab"> {{ trans('admin.general') }} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#meta" data-toggle="tab">{{ trans('admin.extra_info') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#filter" data-toggle="tab">{{ trans('admin.item_filters') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#parts" data-toggle="tab">{{ trans('admin.parts') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#subscribe" data-toggle="tab">{{ trans('admin.subscribe') }}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/content/store/{{$item->id}}/main" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault">{{ trans('admin.th_title') }}</label>
                                <div class="col-md-10">
                                    <input type="text" value="{{ $item->title }}" name="title" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault">{{ trans('admin.course_type') }}</label>
                                <div class="col-md-10">
                                    <select name="type" class="form-control" required>
                                        <option value="single" @if($item->type == 'single') selected @endif>{{ trans('admin.single') }}</option>
                                        <option value="course" @if($item->type == 'course') selected @endif>{{ trans('admin.course') }}</option>
                                        <option value="webinar" @if($item->type == 'webinar') selected @endif>{{ trans('admin.webinar') }}</option>
                                        <option value="course+webinar" @if($item->type == 'course+webinar') selected @endif>{{ trans('admin.course_webinar') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault">{{ trans('admin.th_status') }}</label>
                                <div class="col-md-10">
                                    <select name="mode" class="form-control" required>
                                        <option value="publish" @if($item->mode=='publish') selected @endif>{{ trans('admin.published') }}</option>
                                        <option value="request" @if($item->mode=='request') selected @endif>{{ trans('admin.review_request') }}</option>
                                        <option value="waiting" @if($item->mode=='delete') selected @endif>{{ trans('admin.unpublish_request') }}</option>
                                        <option value="draft" @if($item->mode=='draft') selected @endif>{{ trans('admin.pending') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea class="summernote" name="content" required>{{ $item->content }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" value="0" name="document">
                                        <input type="checkbox" name="document" value="1" class="custom-switch-input" @if($item->document == 1) checked="checked" @endif />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">{{ trans('admin.item_doc') }}</label>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="price" value="1">
                                        <input type="checkbox" name="price" id="free_course" value="0" class="custom-switch-input" @if($item->price == 0) checked="checked" @endif />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">{{ trans('admin.free_course') }}</label>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="support" value="0">
                                        <input type="checkbox" name="support" value="1" class="custom-switch-input" @if($item->support == 1) checked="checked" @endif />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">{{ trans('admin.vendor_supports_item') }}</label>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="post" value="0">
                                        <input type="checkbox" name="post" value="1" class="custom-switch-input" @if($item->post == 1) checked="checked" @endif />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">{{ trans('admin.vendor_postal_sale') }}</label>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="download" value="0">
                                        <input type="checkbox" name="download" value="1" class="custom-switch-input" @if($item->download == 1) checked="checked" @endif />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">{{ trans('admin.download') }}</label>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                    <button class="btn btn-primary pull-left" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="meta" class="tab-pane ">
                        <form action="/admin/content/store/{{$item->id}}/meta" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{ trans('admin.course_cover') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="cover" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="cover" class="form-control" type="text" name="cover" dir="ltr" required value="{{ !empty($meta['cover']) ? $meta['cover'] : ''}}">
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="cover">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">{{ trans('admin.course_thumbnail') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="thumbnail" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="thumbnail" class="form-control" type="text" name="thumbnail" dir="ltr" required value="{{ !empty($meta['thumbnail']) ? $meta['thumbnail'] : ''}}">
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="thumbnail">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">{{ trans('admin.demo') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="video" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="video" class="form-control" type="text" name="video" dir="ltr" required value="{{ !empty($meta['video']) ? $meta['video'] : ''}}">
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="video">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <!--
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{ trans('admin.duration') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" min="0" name="duration" value="{{ !empty($meta['duration']) ? $meta['duration'] : ''}}" class="form-control text-center">
                                        <span class="input-group-append click-for-upload cu-p">
                                            <span class="input-group-text">{{ trans('admin.minutes') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="form-group">
                                <label class="col-md-2 control-label">{{ trans('admin.price') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="price" value="{{  !empty($meta['price']) ? $meta['price'] : ''}}" class="form-control text-center" id="product_price" @if($item->price == 0) disabled="disabled" @endif>
                                        <span class="input-group-append click-for-upload cu-p">
                                            <span class="input-group-text">@if(!empty($meta['price'])) {{ num2str($meta['price']) }} @endif {{ trans('admin.cur_dollar') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">{{ trans('admin.postal_price') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="post_price" value="{{ !empty($meta['post_price']) ? $meta['post_price'] : ''}}" class="form-control text-center numtostr">
                                        <span class="input-group-append click-for-upload cu-p">
                                            <span class="input-group-text">@if(!empty($meta['post_price'])) {{ num2str($meta['post_price']) }} @endif {{ trans('admin.cur_dollar') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <?php
                            if (isset($meta['precourse']) and $meta['precourse'] != '')
                                $preCourseArray = explode(',', rtrim($meta['precourse'], ','));
                            else
                                $preCourseArray = [];
                            ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{ trans('admin.prerequisites') }}</label>
                                <div class="col-md-8">
                                    <select name="precourse[]" multiple="multiple" class="form-control selectric">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" @if(in_array($product->id,$preCourseArray)) selected="selected" @endif>{{ $product->title  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-primary pull-left" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="filter" class="tab-pane ">
                        <form action="/admin/content/store/{{$item->id}}/tags" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}
                            @if(!empty($filters))
                                @foreach($filters as $filter)
                                    <div class="col-md-3 col-xs-12">
                                        <fieldset>
                                            <legend class="custom-legend" style="font-weight: bold;">{{ $filter->filter  }}</legend>
                                            @foreach($filter->tags as $tag)
                                                &nbsp;&nbsp;&nbsp;<input type="checkbox" value="{{ $tag->id }}" name="tags[]" style="position: relative;top: 2px;" {{ checkedInObject($tag->id,'tag_id',$item->tags) }}>&nbsp;{{ $tag->tag  }}<br>
                                            @endforeach
                                        </fieldset>
                                    </div>
                                @endforeach
                            @endif

                            <div class="row h-25"></div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-10">
                                    <button class="btn btn-primary pull-left" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="parts" class="tab-pane ">
                        <table class="table table-bordered table-striped mb-none" id="datatable-details">
                            <thead>
                            <tr>
                                <th>{{ trans('admin.th_title') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.th_date') }}</th>
                                <th class="text-center" width="50">{{ trans('admin.convert_status') }}</th>
                                <th class="text-center" width="50">{{ trans('admin.volume') }} (MB)</th>
                                <th class="text-center" width="50">{{ trans('admin.duration') }} ({{ trans('admin.minute') }})</th>
                                <th class="text-center" width="50">{{ trans('admin.th_status') }}</th>
                                <th class="text-center" width="100">{{ trans('admin.th_controls') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($item->parts as $part)
                                <tr>
                                    <td>{{ $part->title  }}&nbsp;@if($part->free == 1 || $item->price == 0)(Free)@endif</td>
                                    <td class="text-center" width="150">{{ date('d F Y : H:i',$item->created_at) }}</td>
                                    <td class="text-center" width="50">
                                        @php
                                            $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                                            $file = $storagePath.'source/content-'.$part->content->id.'/video/part-'.$part->id.'.mp4';
                                        @endphp
                                        @if(file_exists($file))
                                            <i class="fa fa-check c-g"></i>
                                        @else
                                            <i class="fa fa-times c-r"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ !empty($part->size) ? $part->size : '0' }}</td>
                                    <td class="text-center">{{ !empty($part->duration) ? $part->duration : '0' }}</td>
                                    <td class="text-center" width="100">
                                        @if($part->mode == 'publish')
                                            <b class="c-b">{{ trans('admin.published') }}</b>
                                        @elseif($part->mode == 'draft')
                                            <b class="c-g">{{ trans('admin.draft') }}</b>
                                        @elseif($part->mode == 'request')
                                            <span class="c-g">{{ trans('admin.review_request') }}</span>
                                        @elseif($part->mode == 'delete')
                                            <span class="c-r">{{ trans('admin.unpublish_request') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/content/edit/{{ $item->id }}/part/{{ $part->id }}#part" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a href="#" data-href="/admin/content/part/delete/{{ $part->id }}" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="subscribe" class="tab-pane">
                        <form action="/admin/content/store/{{$item->id}}/subscribe" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">3 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_3" value="{{ $item->price_3 }}" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text">{{ currencySign() }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_3" value="{{ $item->subscribe_3 }}" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">6 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_6" value="{{ $item->price_6 }}" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text">{{ currencySign() }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_6" value="{{ $item->subscribe_6 }}" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">6 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_9" value="{{ $item->price_9 }}" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text">{{ currencySign() }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_9" value="{{ $item->subscribe_9 }}" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">6 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_12" value="{{ $item->price_12 }}" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text">{{ currencySign() }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_12" value="{{ $item->subscribe_12 }}" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-primary pull-left" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#free_course').change(function () {
            if ($(this).is(':checked')) {
                $('#product_price').attr('disabled', 'disabled');
            } else {
                $('#product_price').removeAttr('disabled');
            }
        });
    </script>
@endsection


