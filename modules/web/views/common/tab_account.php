<?php
$tabs = [
    'index' => [
        'title' => "账户列表",
        'url' => "/account/index"
    ],
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