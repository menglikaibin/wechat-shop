<?php
use app\common\services\UrlService;
use app\common\services\StaticService;
use \app\common\services\ConstantMapService;

StaticService::includeAppJsStatic("@web/js/web/book/cat.js", ['depends'=>\app\assets\WebAsset::className()]);
?>
<?= Yii::$app->view->renderFile("@app/modules/web/views/common/tab_book_cat.php",['current'=>'cat'])?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline wrap_search">
            <div class="row  m-t p-w-m">
                <div class="form-group">
                    <select name="status" id="select_test" class="form-control inline">
                        <option value="<?= ConstantMapService::$status_default ?>">请选择状态</option>
                        <?php foreach($status_mapping as $key=>$value):  ?>
                        <option value="<?= $key; ?>" <?php if ($search_conditions['status']==$key): ?>selected<?php endif;?>><?= $status_mapping[$key] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?= UrlService::buildWebUrl("/book/cat-set") ?>">
                        <i class="fa fa-plus"></i>分类
                    </a>
                </div>
            </div>

        </form>
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>序号</th>
                <th>分类名称</th>
                <th>状态</th>
                <th>权重</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($list): ?>
                <?php foreach ($list as $key=>$item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $status_mapping[$item['status']] ?></td>
                    <td><?= $item['weight'] ?></td>
                    <td>
                        <?php if ($item['status']==0):?>
                            <a class="m-l recover" href="javascript:void(0);" data="<?= $item['id'] ?>">
                                <i class="fa fa-rotate-left fa-lg"></i>
                            </a>
                        <?php else: ?>
                            <a class="m-l" href="<?= UrlService::buildWebUrl("/book/cat-set",['id'=>$item['id']]) ?>">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>

                            <a class="m-l remove" href="javascript:void(0);" data="<?= $item['id']?>">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach;?>
            <?php else: ?>
                <tr><td colspan="5">暂无数据</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

