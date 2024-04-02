<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('main.Ready to Leave?')}}</h5>
                <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">{{__('main.Select "Logout" below if you are ready to end your current session.')}}</div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">{{__('main.cancel')}}</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('main.logout')}}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
