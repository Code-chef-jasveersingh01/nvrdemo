<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @if(isset($card_heard) || isset($create_button_href) || isset($create_button_title))
                <div class="card-header d-flex align-items-center">
                    @if(isset($card_heard))
                        <h5 class="card-title mb-0 flex-grow-1">{{ $card_heard}}</h5>
                    @endif
                    @if(isset($create_button_href) && isset($create_button_title) )
                    <div>
                        <a href="{{ $create_button_href }}" type="button" class="btn btn-secondary add-btn" id="create-btn">
                            <i class="ri-add-line align-bottom me-1"></i> {{ $create_button_title}}</a>
                    </div>
                    @endif
                </div>
            @endif
            <div class="card-body">
                @if(isset($search_label))
                    <div class="card-body ">
                        {{$search_label}}
                    </div>
                @endif
                <div class="card-body pt-0">
                    <table id="{{ $table_id }}" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                {{ $table_th }}
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
