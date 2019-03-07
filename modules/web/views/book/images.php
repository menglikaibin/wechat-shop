<?php
use app\common\services\UrlService;
?>
<?= Yii::$app->view->renderFile("@app/modules/web/views/common/tab_book_cat.php", ['current'=>"images"]) ?>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered m-t">
            <thead>
            <tr>
                <th>图片</th>
                <th>图片地址</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($list): ?>
                <?php foreach($list as $item): ?>
                <tr>
                    <td>
                        <img src="<?= $item['url'] ?>"
                             style="width: 100px;height: 100px;"/>
                    </td>
                    <td>
                        <a href="<?= $item['url'] ?>" target="_blank">查看大图</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        <?= Yii::$app->view->renderFile("@app/modules/web/views/common/pagination.php",[
            'pages' => $pages,
            'url' => '/book/images',
            'search_conditions' => []
        ])?>
    </div>
</div>

