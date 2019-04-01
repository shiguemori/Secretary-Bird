<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Configurações</h5>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{ asset('images/user_blank.png') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                <a href="{{ route('admin.administradores.edit', Auth::guard('admin')->user()->id) }}" class="user-edit"><i class="mdi mdi-pencil"></i></a>
            </div>

            <h5><a href="#">{{ Auth::guard('admin')->user()->nome }}</a></h5>
        </div>

        <hr class="mt-0"/>
        <h5 class="pl-3">Módulos</h5>
        <hr class="mb-0"/>
        <div class="btn-group-vertical btn-block pr-2 pl-2">
            <a href="#" class="btn btn-info btn-lg btn-block link-out"><i class="mdi mdi-heart mr-1"></i> <span>Clínica</span></a>
        </div>

        <hr class="mt-0"/>
        <h5 class="pl-3 pr-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
        <hr class="mb-0"/>
        <div class="p-3">
            <div class="inbox-widget">
                <a href="#">
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="{{ asset('images/user_blank.png') }}" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author">Chadengle</p>
                        <p class="inbox-item-text">Hey! there I'm available...</p>
                        <p class="inbox-item-date">13:40 PM</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>