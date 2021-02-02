<div class="container-fluid">
    <div class="row">
        <div class="parts-slider" style="background:url('{{ get_option('main_page_slide','/assets/default/images/view/sample/slider-sample.png') }}');">
            <div class="col-xs-12 col-md-4 col-md-offset-4 parts-slider-container">
                <h2>{{ get_option('main_page_slide_title','') }}</h2>
                <span>{{ get_option('main_page_slide_text','') }}</span>
                <div class="parts-slider-button">
                    <a href="{!! get_option('main_page_slide_btn_1_url','/')  !!}">{{ get_option('main_page_slide_btn_1_text','') }}</a>
                    <a href="{!! get_option('main_page_slide_btn_2_url','/')  !!}">{{ get_option('main_page_slide_btn_2_text','') }}</a>
                </div>
            </div>
            <i class="fa fa-angle-down down-flesh"></i>
        </div>
    </div>
</div>
