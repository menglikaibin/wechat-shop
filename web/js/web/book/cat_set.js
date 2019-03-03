;
let book_cat_set_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        $(".wrap_cat_set .save").click(function () {
            let btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理,请不要重复提交");
                return;
            }
            btn_target.addClass("disabled");

            let name_target = $(".wrap_cat_set input[name=name]");
            let name = name_target.val();

            if (name.length < 1) {
                common_ops.tip("请输入符合规范的名称", name_target);
                return;
            }

            let data = {
                name: name,
                weight: $(".wrap_cat_set input[name=weight]").val(),
                id: $(".wrap_cat_set input[name=id]").val()
            };

            $.ajax({
                url: common_ops.buildWebUrl("/book/cat-set"),
                type: "post",
                dataType: "json",
                data: data,
                success: function (res) {
                    btn_target.removeClass("disabled");
                    let cb = null;
                    if (res.code === 200) {
                        cb = function () {
                            window.location.href = common_ops.buildWebUrl("/book/cat");
                        }
                    }
                    common_ops.alert(res.msg, cb);
                }
            });

        })
    }
};

$(document).ready(function () {
    book_cat_set_ops.init();
});