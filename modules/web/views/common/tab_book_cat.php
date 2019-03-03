<?php
use app\common\services\UrlService;
$tab_list = [
    'book' => [
        'title' => "图书列表",
        'url' => "/book/index"
    ],
    'cat' => [
        'title' => "分类列表",
        'url' => "/book/cat",
    ],
    'images' => [
        'title' => "图书资源",
        'url' => "/book/images"
    ]
]
?>

<div class="row  border-bottom">
    <div class="col-lg-12">
        <div class="tab_title">
            <ul class="nav nav-pills">
                <?php foreach ($tab_list as $key=>$item): ?>
                <li <?php if ($current==$key): ?> class="current" <?php endif;?>>
                    <a href="<?= UrlService::buildWebUrl($item['url']) ?>"><?= $item['title'] ?></a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>