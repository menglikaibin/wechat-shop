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
                    <a href="/web/book/index">图书列表</a>
                </li>
                <li>
                    <a href="/web/book/cat">分类列表</a>
                </li>
                <li>
                    <a href="/web/book/images">图片资源</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form class="form-inline wrap_search">
            <div class="row  m-t p-w-m">
                <div class="form-group">
                    <select name="status" class="form-control inline">
                        <option value="-1">请选择状态</option>
                        <option value="1">正常</option>
                        <option value="0">已删除</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="cat_id" class="form-control inline">
                        <option value="0">请选择分类</option>
                        <option value="2">互联网</option>
                        <option value="1">政治类</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="mix_kw" placeholder="请输入关键字" class="form-control" value="">
                        <span class="input-group-btn">
                            <button type="button" class="btn  btn-primary search">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-w-m btn-outline btn-primary pull-right" href="/web/book/set">
                        <i class="fa fa-plus"></i>图书
                    </a>
                </div>
            </div>

        </form>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>图书名</th>
                <th>分类</th>
                <th>价格</th>
                <th>库存</th>
                <th>标签</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Hadoop权威指南(第3版)</td>
                <td>互联网</td>
                <td>78.20</td>
                <td>130</td>
                <td>hadoop,大数据</td>
                <td>
                    <a href="/web/book/info?id=4">
                        <i class="fa fa-eye fa-lg"></i>
                    </a>
                    <a class="m-l" href="/web/book/set?id=4">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>

                    <a class="m-l remove" href="javascript:void(0);" data="4">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>高性能MySQL（第3版）</td>
                <td>互联网</td>
                <td>101.10</td>
                <td>100</td>
                <td>mysql,index</td>
                <td>
                    <a href="/web/book/info?id=3">
                        <i class="fa fa-eye fa-lg"></i>
                    </a>
                    <a class="m-l" href="/web/book/set?id=3">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>

                    <a class="m-l remove" href="javascript:void(0);" data="3">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>php开发教程</td>
                <td>互联网</td>
                <td>45.00</td>
                <td>92</td>
                <td>php</td>
                <td>
                    <a href="/web/book/info?id=2">
                        <i class="fa fa-eye fa-lg"></i>
                    </a>
                    <a class="m-l" href="/web/book/set?id=2">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>

                    <a class="m-l remove" href="javascript:void(0);" data="2">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>浪潮之巅</td>
                <td>政治类</td>
                <td>88.88</td>
                <td>5</td>
                <td>浪潮,吴军</td>
                <td>
                    <a href="/web/book/info?id=1">
                        <i class="fa fa-eye fa-lg"></i>
                    </a>
                    <a class="m-l" href="/web/book/set?id=1">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>

                    <a class="m-l remove" href="javascript:void(0);" data="1">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <span class="pagination_count" style="line-height: 40px;">共4条记录 | 每页50条</span>
                <ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">
                    <li class="active"><a href="javascript:void(0);">1</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

