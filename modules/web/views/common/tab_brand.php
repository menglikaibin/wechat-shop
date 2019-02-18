<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2019/2/18
 * Time: 15:44
 */
$tabs = [
    'info' => [
        'title' => '品牌信息',
        'url' => '/brand/set'
    ],
    'images' => [
        'title' => '品牌相册',
        'url' => '/brand/images'
    ]
]
?>


<div class="row  border-bottom">
    <div class="col-lg-12">
        <div class="tab_title">
            <ul class="nav nav-pills">
                <?php foreach ($tabs as $key => $tab) : ?>
                    <li <?php if ($current==$key): ?> class="current" <?php endif; ?>>
                        <a href="<?= \app\common\services\UrlService::buildWebUrl($tab['url'])?>"><?= $tab['title'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

