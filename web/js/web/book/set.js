;
upload = {
    error: function (msg) {
        $.alert(msg)
    },
    success: function (file_key) {
        if (!file_key) {
            return;
        }
        let html = '<img src="'+common_ops.buildPicUrl("book",file_key)+'"/>' +
                   '<span class="fa fa-times-circle del del_image" data="'+file_key+'">' +
                   '</span>';
        let ele = $(".pic-each");
        if (ele.size() > 0) {
            ele.html(html);
        } else {
            $(".upload_pic_wrap").append('<span class="pic-each">' + html + '</span>');
        }
        book_set_ops.delete_img();
    }
};

let book_set_ops = {
    init: function () {
        this.eventBind();
        this.ue = null;
        this.initEditor();
    },
    eventBind: function () {
        let that = this;
        //选择分类
        $("#cat_id").select2({
            language: "zh-CN",
            width: "100%"
        });

        //提交图片
        $(".wrap_book_set .upload_pic_wrap input[name=pic]").change(function () {
            $(".wrap_book_set .upload_pic_wrap").submit();
        });

        //标签
        $("#tags").tagsInput({
            width: 'auto',
            height: 40,
            onAddTag: function (tag) {
            },
            onRemoveTag: function (tag) {
            }
        });

        $(".wrap_book_set .save").click(function () {
            let btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理,请不要重复提交");
                return;
            }
            btn_target.addClass("disabled");

            //分类
            let cat_id_target = $(".wrap_book_set select[name=cat_id]");
            let cat_id = cat_id_target.val();

            //书名
            let name_target = $(".wrap_book_set input[name=name]");
            let name = name_target.val();

            //价格
            let price_target = $(".wrap_book_set input[name=price]");
            let price = price_target.val();

            //图书简介
            let summary = $.trim(that.ue.getContent());

            //库存
            let stock_target = $(".wrap_book_set input[name=stock]");
            let stock = stock_target.val();

            //标签
            let tags_target = $(".wrap_book_set input[name=tags]");
            let tags = tags_target.val();

            if (parseInt(cat_id) < 1) {
                common_ops.tip("请输入图书分类", cat_id_target);
                return;
            }

            if (name.length < 1) {
                common_ops.tip("请输入符合规范的名称", name_target);
                return;
            }

            if (parseFloat(price) < 0) {
                common_ops.tip("请输入符合规范的售卖价格", price_target);
                return;
            }

            if ($(".pic-each").size() < 1) {
                common_ops.tip("请上传封面图片");
                return;
            }

            if (summary.length < 10) {
                common_ops.tip("请输入书本描述,且不能小于10个字符", price_target);
                return;
            }

            if (parseInt(stock) < 1) {
                common_ops.tip("请输入符合规范的库存量", stock_target);
                return;
            }

            if (tags.length < 1) {
                common_ops.alert("请输入图书标签,便于搜索");
                return;
            }

            let data = {
                cat_id: cat_id,
                name: name,
                price: price,
                main_image: $(".pic-each .del_image").attr("data"),
                summary: summary,
                stock: stock,
                tags: tags,
                id: $(".wrap_book_set input[name=id]").val()
            };

            $.ajax({
                url: common_ops.buildWebUrl("/book/set"),
                type: "post",
                dataType: "json",
                data: data,
                success: function (res) {
                    btn_target.removeClass("disabled");
                    let callback = null;
                    if (res.code === 200) {
                        callback = function () {
                            window.location.href = common_ops.buildWebUrl("/book/index");
                        }
                    }
                    common_ops.alert(res.msg, callback);
                }
            })


        })
    },
    initEditor: function () {
        let that = this;
        that.ue = UE.getEditor('editor',{
            toolbars: [
                [ 'undo', 'redo', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall',  '|','rowspacingtop', 'rowspacingbottom', 'lineheight'],
                [ 'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                    'directionalityltr', 'directionalityrtl', 'indent', '|',
                    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                    'link', 'unlink'],
                [ 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                    'insertimage', 'insertvideo', '|',
                    'horizontal', 'spechars','|','inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols' ]
            ],
            enableAutoSave:true,
            saveInterval:60000,
            elementPathEnabled:false,
            zIndex:4,
            serverUrl:common_ops.buildWebUrl('/upload/ueditor')
        });
        that.ue.addListener('beforeInsertImage', function (t,arg){
            console.log( t,arg );
            //alert('这是图片地址：'+arg[0].src);
            // that.ue.execCommand('insertimage', {
            //     src: arg[0].src,
            //     _src: arg[0].src,
            //     width: '250'
            // });
            return false;
        });
    },
    delete_img: function () {
        $(".upload_pic_wrap .del_image").unbind().click(function () {
            $(this).parent().remove();
        });
    }
};


$(document).ready(function () {
    book_set_ops.init();
});