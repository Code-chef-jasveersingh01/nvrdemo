<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    setInterval( notification, 3000 );

    function notification()
    {
    $.ajax({
    type: "POST",
    url: "{{route('admin.newOrderNotification')}}",
    data: "data",
    success: function (response) {
        var newNotification = $('.notification-count').data('id');
        if (response.length != newNotification)
        {
            $('.notification-count').html('');
            $('.notification-count').append(response.length);
            $('#notificationItemsTabContent').html('');

            if (response.length === 0)
            {
                const message = '<div class="tab-pane fade show active py-2 ps-2 notification-inner-menu" id="all-noti-tab" role="tabpanel" aria-labelledby="all-noti-tab"><div class="w-25 w-sm-50 pt-3 mx-auto"><img src="{{ URL::asset("assets/images/svg/bell.svg") }}" class="img-fluid" alt="user-pic"></div><div class="text-center pb-5 mt-2"><h6 class="fs-18 fw-semibold lh-base">{{__("main.Hey! You have no any notifications") }}</h6></div></div>';
                const a = $('#notificationItemsTabContent').append(message);
            }else{
                let innerLi = $.map(response, function (element, index) {
                    let item = "<div class='text-reset notification-item d-block dropdown-item position-relative'><div class='d-flex'><div class='avatar-xs me-3'><span class='avatar-title bg-soft-info text-info rounded-circle fs-16'><i class='bx bx-badge-check'></i></span></div><div class='flex-1'><a class='stretched-link mark-as-read' href='{{route('admin.orderItemDetails',"")}}/"+element.data.order_id+"' data-id="+element.id+"><h6 class='mt-0 mb-2 lh-base'> New Order no. "+element.data.order_id+".</h6></a></div></div></div>";
                    return item;
                }).join('');
                let innerUl = '<div class="tab-pane fade show active py-2 ps-2 notification-inner-menu" id="all-noti-tab" role="tabpanel"><div data-simplebar style="max-height: 300px;" class="pe-2">'+innerLi+'<div class="my-3 text-center"><a class="btn btn-soft-success waves-effect waves-light mark-all" href="{{route("admin.allOrderList")}}"> {{__("main.view_all")}}<i class="ri-arrow-right-line align-middle"></i></a></div></div></div>';
                const a = $('#notificationItemsTabContent').append(innerUl);
            }

            newNotification = response.length;
            $('.notification-count').data('id',newNotification);
        }else{
            newNotification = newNotification;
        }
        }
    });
    }
});
</script>
<script>
    $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        function sendMarkRequest(id = null) {
        return $.ajax("{{ route('admin.markNotification') }}", {
            method: 'POST',
            data: {
                id
            }
        });
    }
    $(function() {
        $('body').on('click','.mark-as-read',function(e) {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                var notificationCount = $('.notification-count').data('id');
            });
        });
        $('body').on('click','.mark-all',function(e) {
            let request = sendMarkRequest();
            request.done(() => {
            })
        });
    });
    });
</script>
