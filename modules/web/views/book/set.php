<?php
use app\common\services\StaticService;
use app\common\services\UrlService;

//引入富文本编辑器插件
StaticService::includeAppJsStatic("@web/js/plugins/ueditor/ueditor.all.js", ['depends'=>\app\assets\WebAsset::className()]);
StaticService::includeAppJsStatic("@web/js/plugins/ueditor/ueditor.config.js", ['depends'=>\app\assets\WebAsset::className()]);
StaticService::includeAppJsStatic("@web/js/plugins/ueditor/lang/zh-cn/zh-cn.js", ['depends'=>\app\assets\WebAsset::className()]);

//引入select2插件
StaticService::includeAppCssStatic("@web/js/plugins/select2/select2.min.css", ['depends'=>\app\assets\WebAsset::className()]);
StaticService::includeAppJsStatic("@web/js/plugins/select2/pinyin.core.js", ['depends'=>\app\assets\WebAsset::className()]);
StaticService::includeAppJsStatic("@web/js/plugins/select2/select2.pinyin.js", ['depends'=>\app\assets\WebAsset::className()]);
StaticService::includeAppJsStatic("@web/js/plugins/select2/zh-CN.js", ['depends'=>\app\assets\WebAsset::className()]);

//引入tagsinput插件
StaticService::includeAppJsStatic("@web/js/plugins/tagsinput/jquery.tagsinput.min.js", ['depends'=>\app\assets\WebAsset::className()]);
StaticService::includeAppCSSStatic("@web/js/plugins/tagsinput/jquery.tagsinput.min.css", ['depends'=>\app\assets\WebAsset::className()]);


StaticService::includeAppJsStatic("@web/js/web/book/set.js", ['depends'=>\app\assets\WebAsset::className()]);
?>

<?= Yii::$app->view->renderFile("@app/modules/web/views/common/tab_book_cat.php", ['current'=>"book"]) ?>

<div class="row mg-t20 wrap_book_set">
    <div class="col-lg-12">
        <h2 class="text-center">图书设置</h2>
        <div class="form-horizontal m-t">
            <div class="form-group">
                <label class="col-lg-2 control-label">图书分类:</label>
                <div class="col-lg-10">
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="0">请选择分类</option>
                        <?php foreach ($cat_list as $key=>$item): ?>
                        <option value="<?= $item['id'] ?>" <?php if($info && $item['id']==$info['cat_id']): ?> selected <?php endif; ?>><?= $item['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-lg-2 control-label">图书名称:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="请输入图书名" name="name" value="<?= $info?$info['name']:"" ?>">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-lg-2 control-label">图书价格:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="请输入图书售价" name="price" value="<?= $info?$info['price']:"" ?>">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-lg-2 control-label">封面图:</label>
                <div class="col-lg-10">
                    <form class="upload_pic_wrap" target="upload_file" enctype="multipart/form-data" method="POST"
                          action="<?= UrlService::buildWebUrl("/upload/pic"); ?>">
                        <div class="upload_wrap pull-left">
                            <i class="fa fa-upload fa-2x"></i>
                            <input type="hidden" name="bucket" value="book"/>
                            <input type="file" name="pic" accept="image/png, image/jpeg, image/jpg,image/gif">
                        </div>
                        <?php if($info && $info['main_image']): ?>
                        <span class="pic-each">
                            <img src="<?= UrlService::buildPicUrl("book", $info['main_image']); ?>" alt="120*200">
                            <span class="fa fa-times-circle del del_image" data="<?= $info['main_image']; ?>"><i></i></span>
                        </span>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-lg-2 control-label">图书描述:</label>
                <div class="col-lg-8">
                    <textarea id="editor" name="summary" style="height: 300px;"></textarea>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-lg-2 control-label">库存:</label>
                <div class="col-lg-2">
                    <div class="input-group">
                        <div class="input-group-addon hidden">
                            <a class="disabled" href="javascript:void(0);">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                        <input type="text" name="stock" class="form-control" value="<?= $info?$info['stock']:1 ?>">
                        <div class="input-group-addon hidden">
                            <a href="javascript:void(0);">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-lg-2 control-label">图书标签:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="tags" id="tags" value="<?= $info?$info['tags']:"" ?>">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <input type="hidden" name="id" value="<?= $info?$info['id']:"" ?>">
                    <button class="btn btn-w-m btn-outline btn-primary save">保存</button>
                </div>
            </div>

        </div>
    </div>
</div>

<iframe name="upload_file" class="hide"></iframe>
