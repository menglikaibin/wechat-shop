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
                <li>
                    <a href="/web/stat/index">财务统计</a>
                </li>
                <li>
                    <a href="/web/stat/product">商品售卖</a>
                </li>
                <li>
                    <a href="/web/stat/member">会员消费统计</a>
                </li>
                <li class="current">
                    <a href="/web/stat/share">分享统计</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row m-t">
    <div class="col-lg-12" id="container" style="height: 400px;">

    </div>
    <div class="col-lg-12 m-t">
        <form class="form-inline" id="search_form_wrap">
            <div class="row p-w-m">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" placeholder="请选择开始时间" name="date_from" class="form-control"
                               value="2017-03-10">
                    </div>
                </div>
                <div class="form-group m-r m-l">
                    <label>至</label>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" placeholder="请选择结束时间" name="date_to" class="form-control" value="2017-04-09">
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-w-m btn-outline btn-primary search">搜索</a>
                </div>
            </div>
            <hr/>
        </form>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>日期</th>
                <th>分享次数</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>2017-03-16</td>
                <td>1367</td>
            </tr>
            <tr>
                <td>2017-03-15</td>
                <td>1109</td>
            </tr>
            <tr>
                <td>2017-03-14</td>
                <td>1201</td>
            </tr>
            <tr>
                <td>2017-03-13</td>
                <td>1829</td>
            </tr>
            <tr>
                <td>2017-03-12</td>
                <td>1887</td>
            </tr>
            <tr>
                <td>2017-03-11</td>
                <td>1857</td>
            </tr>
            <tr>
                <td>2017-03-10</td>
                <td>1576</td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <span class="pagination_count" style="line-height: 40px;">共7条记录 | 每页50条</span>
                <ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">
                    <li class="active"><a href="javascript:void(0);">1</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
