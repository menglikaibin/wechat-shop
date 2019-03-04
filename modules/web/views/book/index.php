<?php
use app\common\services\StaticService;
use app\common\services\UrlService;
use app\common\services\ConstantMapService;
StaticService::includeAppJsStatic("@web/js/web/book/index.js", ['depends'=>\app\assets\WebAsset::className()]);
?>

<?= Yii::$app->view->renderFile("@app/modules/web/views/common/tab_book_cat.php", ['current'=>"book"]); ?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-inline wrap_search">
            <div class="row  m-t p-w-m">
                <div class="form-group">
                    <select name="status" class="form-control inline">
                        <option value="<?= ConstantMapService::$status_default; ?>">请选择状态</option>
                        <?php foreach($status_mapping as $key=>$value): ?>
                        <option value="<?= $key ?>" <?php if($search_conditions['status']==$key):  ?><?php endif; ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="cat_id" class="form-control inline">
                        <option value="0">请选择分类</option>
                        <?php foreach($cat_mapping as $key=>$item): ?>
                        <option value="<?= $item['id'] ?>" <?php if($search_conditions['cat_id']==$item['id']): ?> selected <?php endif;?>><?= $item['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="mix_kw" placeholder="请输入关键字" class="form-control" value="<?= $search_conditions['mix_kw']; ?>">
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
                    <a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?= UrlService::buildWebUrl("/book/set") ?>">
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
            <?php if ($list): ?>
            <?php foreach($list as $key => $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['cat_name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['stock'] ?></td>
                <td><?= $item['tags'] ?></td>
                <td>
                    <?php if($item['status']==1): ?>
                        <a href="<?= UrlService::buildWebUrl("/book/info", ['id'=>$item['id']]);?>">
                            <i class="fa fa-eye fa-lg"></i>
                        </a>

                        <a class="m-l" href="<?= UrlService::buildWebUrl("/book/set", ['id'=>$item['id']]);?>">
                            <i class="fa fa-edit fa-lg"></i>
                        </a>

                        <a class="m-l remove" href="javascript:void(0);" data="<?= $item['id']; ?>">
                            <i class="fa fa-trash fa-lg"></i>
                        </a>
                    <?php else:?>
                        <a class="m-l recover" href="javascript:void(0);" data="<?= $item['id'] ?>">
                            <i class="fa fa-rotate-left fa-lg"></i>
                        </a>
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo \Yii::$app->view->renderFile("@app/modules/web/views/common/pagination.php", [
            'pages' => $pages,
            'url' => '/book/index',
            'search_conditions' => [],
        ]); ?>
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--                <span class="pagination_count" style="line-height: 40px;">共4条记录 | 每页50条</span>-->
<!--                <ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">-->
<!--                    <li class="active"><a href="javascript:void(0);">1</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>

