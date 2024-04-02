<div class="modal fade" id="downloadOrderDetailseModal" tabindex="-1" role="dialog" aria-labelledby="downloadOrderDetails" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadOrderDetailse">{{ __('main.download_order_details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
            </div>
            <div class="modal-body">
                <form class="form" method="get" action="{{route('admin.order.download')}}" id="downloadOrderDetailseForm">
                    @csrf
                    <input type="hidden" name="download_type" id="download_type">
                    <input type="hidden" name="order_status" id="order_status">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label class="form-label mb-0">{{__('main.date_range')}}</label>
                            <input type="text" class="form-control" name="filter_date" data-provider="flatpickr" data-maxDate="today" data-date-format="Y-m-d" data-range-date="true" data-altFormat="F j, Y">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('main.close') }}</button>
                <button type="button" class="btn btn-primary download" form="downloadOrderDetailseForm" data-download-type="csv"><i class="fa fa-file-excel" aria-hidden="true"></i> {{ __('main.csv') }}</button>
            </div>
        </div>
    </div>
</div>
