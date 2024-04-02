<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $title ?? '' }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if(isset($li_1))
                        <li class="breadcrumb-item">{{ $li_1 }}</li>
                    @endif
                    @if(isset($li_2))
                        <li class="breadcrumb-item">{{ $li_2 }}</li>
                    @endif
                    @if(isset($title))
                        <li class="breadcrumb-item active"><a href="{{ $link ?? '#' }}">{{ $title }}</a></li>
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
