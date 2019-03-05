;
let book_ops = {
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
        
        $(".wrap_search .search").click(function () {
            $(".wrap_search").submit();
        })
    },
    ops: function (act, id) {
        let callback = {
            'ok': function () {
                $.ajax({
                    url: common_ops.buildWebUrl("/book/ops"),
                    type: "post",
                    data: {act: act, id: id},
                    dataType: "json",
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
    book_ops.init();
});
