<?php
use \app\common\services\UtilService;
?>

<?php if ($image_list): ?>
<div id="slideBox" class="slideBox">
    <div class="bd">
        <ul>
            <li>
                <img style="max-height: 250px;" src="/uploads/brand/20170303/fe3545ecaef7e24a302231f5635713af.jpg"/>
            </li>
            <li>
                <img style="max-height: 250px;" src="/uploads/brand/20170303/7a976289c2c1f551a4f21232575ba255.jpg"/>
            </li>
            <li>
                <img style="max-height: 250px;" src="/uploads/brand/20170303/a8887738ab1bfd71765dd063fee4ddaa.jpg"/>
            </li>
            <li>
                <img style="max-height: 250px;" src="/uploads/brand/20170303/1451ab22b16175889efffa21ec41b824.jpg"/>
            </li>
            <li>
                <img style="max-height: 250px;" src="/uploads/brand/20170303/e9a3909b1c2db975d1b3c21c249c684e.jpg"/>
            </li>
        </ul>
    </div>
    <div class="hd">
        <ul></ul>
    </div>
</div>
<?php endif;?>
<div class="fastway_list_box">
    <ul class="fastway_list">
        <li><a href="javascript:void(0);" style="padding-left: 0.1rem;"><span>品牌名称：<?= UtilService::encode($info['name']) ?></span></a></li>
        <li><a href="javascript:void(0);" style="padding-left: 0.1rem;"><span>联系电话：<?= UtilService::encode($info['mobile']) ?></span></a></li>
        <li><a href="javascript:void(0);"
               style="padding-left: 0.1rem;"><span>联系地址：<?= UtilService::encode($info['address']) ?></span></a></li>
        <li><a href="javascript:void(0);" style="padding-left: 0.1rem;"><span>品牌介绍：<?= UtilService::encode($info['description']) ?></span></a>
        </li>
    </ul>
</div>



