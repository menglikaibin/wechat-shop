<?php
use app\common\services\StaticService;
StaticService::includeAppJsStatic("/js/web/account/set.js", ['depends' => app\assets\WebAsset::className()]);
?>
<div class="row  border-bottom">
    <div class="col-lg-12">
        <div class="tab_title">
            <ul class="nav nav-pills">
                <li class="current">
                    <a href="/web/account/index">账户列表</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row m-t  wrap_account_set">
    <div class="col-lg-12">
        <h2 class="text-center">账号设置</h2>
        <div class="form-horizontal m-t m-b">
            <div class="form-group">
                <label class="col-lg-2 control-label">姓名:</label>
                <div class="col-lg-10">
                    <input type="text" name="nickname" class="form-control" placeholder="请输入姓名~~" value="郭威">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-lg-2 control-label">手机:</label>
                <div class="col-lg-10">
                    <input type="text" name="mobile" class="form-control" placeholder="请输入手机~~" value="11012345678">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-lg-2 control-label">邮箱:</label>
                <div class="col-lg-10">
                    <input type="text" name="email" class="form-control" placeholder="请输入邮箱~~" value="apanly@163.com">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-lg-2 control-label">登录名:</label>
                <div class="col-lg-10">
                    <input type="text" name="login_name" class="form-control" autocomplete="off" placeholder="请输入登录名~~"
                           value="test4">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-lg-2 control-label">登录密码:</label>
                <div class="col-lg-10">
                    <input type="password" name="login_pwd" class="form-control" autocomplete="new-password"
                           placeholder="请输入登录密码~~" value="******">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="id" value="13">
                    <button class="btn btn-w-m btn-outline btn-primary save">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>

