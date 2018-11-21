<?php
use app\common\services\UrlService;
use app\common\services\ConstantMapService;
use app\common\services\StaticService;

StaticService::includeAppJsStatic("@web/js/web/account/index.js", ['depends' => \app\assets\WebAsset::className()]);
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
<div class="row">
    <div class="col-lg-12">
        <form class="form-inline wrap_search">
            <div class="row m-t p-w-m">
                <div class="form-group">
                    <select name="status" class="form-control inline">
                        <option value="<?= ConstantMapService::$status_default; ?>">请选择状态</option>
                        <?php foreach($status_mapping as $status => $item): ?>
                        <option value="<?= $status?>"><?php if ($status==$search_status['status']):?>selected<?php endif; ?><?= $item?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="mix_kw" placeholder="请输入姓名或者手机号码" class="form-control" value="<?= $search_status['mix_kw'];?>">
                        <input type="hidden" name="p" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary search">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-w-m btn-outline btn-primary pull-right" href="/web/account/set">
                        <i class="fa fa-plus"></i>账号
                    </a>
                </div>
            </div>
        </form>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>序号</th>
                <th>姓名</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $item): ?>
            <tr>
                <td><?= $item['uid']?></td>
                <td><?= $item['nickname']?></td>
                <td><?= $item['mobile']?></td>
                <td><?= $item['email']?></td>
                <td>
                    <a href="<?= UrlService::buildWebUrl("/account/info",['id'=>$item['uid']])?>">
                        <i class="fa fa-eye fa-lg"></i>
                    </a>
                    <a class="m-l" href="<?= UrlService::buildWebUrl("/account/set",['id'=>$item['uid']])?>">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>

                    <a class="m-l remove" href="javascript:void(0);" data="<?= $item['uid']?>">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <span class="pagination_count" style="line-height: 40px;">共2条记录 | 每页50条</span>
                <ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">
                    <li class="active"><a href="javascript:void(0);">1</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


