<?php
use app\common\services\StaticService;
use app\common\services\UrlService;
use app\common\services\ConstantMapService;

StaticService::includeAppJsStatic("@web/js/web/member/index.js", ['depends' => \app\assets\WebAsset::className()]);
?>

<?= Yii::$app->view->renderFile("@app/modules/web/views/common/tab_member.php", ['current'=>"index"]); ?>
<div class="row">
    <div class="col-lg-12">
        <form class="form-inline wrap_search">
            <div class="row  m-t p-w-m">
                <div class="form-group">
                    <select name="status" class="form-control inline">
                        <option value="<?= ConstantMapService::$status_default ?>">请选择状态</option>
                        <?php foreach($status_mapping as $key => $value): ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="mix_kw" placeholder="请输入关键字" class="form-control" value="<?= $search_conditions['mix_kw'] ?>">
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
                    <a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?= UrlService::buildWebUrl("/member/set") ?>">
                        <i class="fa fa-plus"></i>会员
                    </a>
                </div>
            </div>

        </form>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>头像</th>
                <th>姓名</th>
                <th>手机</th>
                <th>性别</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($member_list): ?>
                <?php foreach($member_list as $member): ?>
                <tr>
                    <td>
                        <img alt="image" class="img-circle" src="/uploads/avatar/20170313/159419a875565b1afddd541fa34c9e65.jpg" style="width: 40px;height: 40px;">
                    </td>
                    <td><?= $member ? $member['nickname'] : "" ?></td>
                    <td><?= $member ? $member['mobile'] : "" ?></td>
                    <td><?= $member ? $member['sex_desc'] : "" ?></td>
                    <td><?= $member ? $member['status_desc'] : "" ?></td>
                    <?php if ($member): ?>
                    <td>
                        <a href="<?= UrlService::buildWebUrl("/member/info", ['id'=>$member['id']]) ?>">
                            <i class="fa fa-eye fa-lg"></i>
                        </a>
                        <?php if ($member['status']):?>
                            <a class="m-l" href="<?= UrlService::buildWebUrl("/member/set", ['id' => $member['id']]) ?>">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>

                            <a class="m-l remove" href="<?= UrlService::buildNullUrl() ?>" data="<?= $member['id'] ?>">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        <?php else: ?>
                            <a class="m-l recover" href="<?= UrlService::buildNullUrl() ?>" data="<?= $member['id'] ?>">
                                <i class="fa fa-rotate-left fa-lg"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">暂无数据</td></tr>
            <?php endif; ?>
            </tbody>
        </table>

        <?= Yii::$app->view->renderFile("@app/modules/web/views/common/pagination.php",[
                'pages' => $pages,
                'url' => '/member/index',
                'search_conditions' => []
        ])
        ?>
    </div>
</div>

