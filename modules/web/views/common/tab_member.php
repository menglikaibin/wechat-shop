<?php
use app\common\services\UrlService;

$tab_list = [
    'index' => [
        'title' => '会员列表',
        'url'   => '/member/index'
    ],
    'comment' => [
        'title' => '会员评论',
        'url'   => '/member/comment'
    ]
]

?>

<div class="row  border-bottom">
    <div class="col-lg-12">
        <div class="tab_title">
            <ul class="nav nav-pills">
                <?php foreach ($tab_list as $key => $item): ?>
                <li <?php if ($current==$key): ?>class="current"<?php endif; ?>>
                    <a href="<?= UrlService::buildWebUrl($item['url']) ?>"><?= $item['title']; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>