<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);"><i
                        class="fa fa-bars"></i> </a>

        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
						<span class="m-r-sm text-muted welcome-message">
                            欢迎使用编程浪子图书商城管理后台
                        </span>
            </li>
            <li class="hidden">
                <a class="count-info" href="javascript:void(0);">
                    <i class="fa fa-bell"></i>
                    <span class="label label-primary">8</span>
                </a>
            </li>


            <li class="dropdown user_info">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
                    <img alt="image" class="img-circle" src="/images/web/avatar.png"/>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <div class="dropdown-messages-box">
                            姓名：编程浪子郭大爷 <a href="/web/user/edit" class="pull-right">编辑</a>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            手机号码：11012345679
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="link-block text-center">
                            <a class="pull-left" href="/web/user/reset-pwd">
                                <i class="fa fa-lock"></i> 修改密码
                            </a>
                            <a class="pull-right" href="/web/user/logout">
                                <i class="fa fa-sign-out"></i> 退出
                            </a>
                        </div>
                    </li>
                </ul>
            </li>

        </ul>

    </nav>
</div>

<div class="row  border-bottom">
    <div class="col-lg-12">
        <div class="tab_title">
            <ul class="nav nav-pills">
                <li class="current">
                    <a href="/web/qrcode/index">渠道二维码</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row m-t  wrap_qrcode_set">
    <div class="col-lg-12">
        <h2 class="text-center">渠道二维码设置</h2>
        <div class="form-horizontal m-t m-b">
            <div class="form-group">
                <label class="col-lg-2 control-label">渠道名称:</label>
                <div class="col-lg-10">
                    <input type="text" name="name" class="form-control" placeholder="请输入渠道名称~~" value="慕课渠道">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="id" value="2">
                    <button class="btn btn-w-m btn-outline btn-primary save">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>

