
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);"><i class="fa fa-bars"></i> </a>

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
                        <a  class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
                            <img alt="image" class="img-circle" src="/images/web/avatar.png" />
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    姓名：编程浪子郭大爷                                    <a href="/web/user/edit" class="pull-right">编辑</a>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    手机号码：11012345679                                </div>
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
                        <li  class="current"  >
                            <a href="/web/finance/index">订单列表</a>
                        </li>
                        <li  >
                            <a href="/web/finance/account">财务流水</a>
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
                                <option value="1"  >已支付</option>
                                <option value="-8"  >待支付</option>
                                <option value="0"  >已关闭</option>
                            </select>
                        </div>
                    </div>
                </form>
                <hr/>
                <table class="table table-bordered m-t">
                    <thead>
                    <tr>
                        <th>订单编号</th>
                        <th>名称</th>
                        <th>价格</th>
                        <th>支付时间</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2017031732</td>
                        <td>
                            Hadoop权威指南(第3版) × 1<br/>
                            高性能MySQL（第3版） × 1<br/>
                        </td>
                        <td>179.30</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-17 14:57</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=32">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017031231</td>
                        <td>
                            php开发教程 × 3<br/>
                        </td>
                        <td>135.00</td>
                        <td>
                            2017-03-12 22:28													</td>
                        <td>已支付</td>
                        <td>2017-03-12 19:45</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=31">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017031230</td>
                        <td>
                            php开发教程 × 3<br/>
                        </td>
                        <td>135.00</td>
                        <td>
                            2017-03-12 22:28													</td>
                        <td>已支付</td>
                        <td>2017-03-12 19:45</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=30">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017031229</td>
                        <td>
                            php开发教程 × 2<br/>
                        </td>
                        <td>90.00</td>
                        <td>
                        </td>
                        <td>待支付</td>
                        <td>2017-03-12 19:44</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=29">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017031228</td>
                        <td>
                            浪潮之巅 × 1<br/>
                        </td>
                        <td>88.88</td>
                        <td>
                            2017-03-12 15:51													</td>
                        <td>已支付</td>
                        <td>2017-03-12 15:24</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=28">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017031227</td>
                        <td>
                            浪潮之巅 × 1<br/>
                        </td>
                        <td>88.88</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-12 15:17</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=27">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030726</td>
                        <td>
                            php开发教程 × 1<br/>
                        </td>
                        <td>45.00</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-07 18:16</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=26">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030725</td>
                        <td>
                            php开发教程 × 1<br/>
                        </td>
                        <td>45.00</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-07 17:41</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=25">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030724</td>
                        <td>
                            php开发教程 × 1<br/>
                        </td>
                        <td>45.00</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-07 17:41</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=24">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030717</td>
                        <td>
                            php开发教程 × 1<br/>
                        </td>
                        <td>45.00</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-07 17:35</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=17">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030716</td>
                        <td>
                            浪潮之巅 × 1<br/>
                        </td>
                        <td>88.88</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-07 17:34</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=16">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030715</td>
                        <td>
                            浪潮之巅 × 1<br/>
                        </td>
                        <td>88.88</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-07 17:26</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=15">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030614</td>
                        <td>
                            php开发教程 × 1<br/>
                        </td>
                        <td>45.00</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-06 08:39</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=14">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017030513</td>
                        <td>
                            浪潮之巅 × 1<br/>
                        </td>
                        <td>88.88</td>
                        <td>
                        </td>
                        <td>已关闭</td>
                        <td>2017-03-05 20:47</td>
                        <td>
                            <a  href="/web/finance/pay_info?id=13">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pagination_count" style="line-height: 40px;">共14条记录 | 每页50条</span>
                        <ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">
                            <li class="active"><a href="javascript:void(0);">1</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

