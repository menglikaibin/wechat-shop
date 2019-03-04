;
let book_cat_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        let that = this;
        $(".remove").click(function () {
            that.ops("remove", $(this).attr("data"));
        });
        $(".recover").click(function () {
            that.ops("recover", $(this).attr("data"));
        });
        $(".wrap_search select[name=stauts]").change(function () {
            $(".wrap_search").submit();
        });
    },
    ops: function (act, id) {
        let callback = {
            'ok': function () {
                $.ajax({
                    url: common_ops.buildWebUrl("/book/cat-ops"),
                    type: "post",
                    dataType: "json",
                    data: {act: act, id: id},
                    success: function (res) {
                        let cb = null;
                        if (res.code === 200) {
                            cb = function () {
                                window.location.reload();
                            }
                        }
                        common_ops.alert(res.msg, cb);
                    }
                })
            },
            'cancel': null
        };
        common_ops.confirm(act==="remove"?"确认删除?":"确认恢复?", callback);
    }
};

$(document).ready(function () {
    book_cat_ops.init();
});
