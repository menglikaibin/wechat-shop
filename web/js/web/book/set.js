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
    },
    eventBind: function () {
        let that = this;
        //选择分类
        $("#cat_id").select2({
            language: "zh-CN",
            width: "100%"
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
        //提交图片
        $(".wrap_book_set .upload_pic_wrap input[name=pic]").change(function () {
            $(".wrap_book_set .upload_pic_wrap").submit();
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
            let name_target = $(".wrap_book_set select[name=name]");
            let name = name_target.val();

            //价格
            let price_target = $(".wrap_book_set select[name=price]");
            let price = price_target.val();

            let summary = $.trim();

        })

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