<?php
$tabs = [
    'edit' => [
        'title' => "信息编辑",
        'url' => "/user/edit"
    ],
    'pwd' => [
        'title' => "修改密码",
        'url' => '/user/reset-pwd'
    ]
]
?>


<div class="row  border-bottom">
    <div class="col-lg-12">
        <div class="tab_title">
            <ul class="nav nav-pills">
                <?php foreach ($tabs as $key => $tab): ?>
                <li <?php if ($current==$key): ?> class="current" <?php endif; ?>>
                    <a href="<?= \app\common\services\UrlService::buildWebUrl($tab['url'])?>"><?= $tab['title']?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>