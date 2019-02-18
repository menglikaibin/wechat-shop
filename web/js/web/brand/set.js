;
var brand_set_ops = {
    init : function () {
        $(this).eventBind();
    },
    
    eventBind: function () {
        $(".wrap_brand_set .save").click(function () {
            var btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理,请不要重复点击");
                return;
            }

            var name_target = $(".wrap_brand_set input[name=name]");
            var name = name_target.val();
            var mobile_target = $(".wrap_brand_set input[name=mobile]");
            var mobile = mobile_target.val();
            var address_target = $(".wrap_brand_set input[name=address]");
            var address = address_target.val();

            var description_target = $(".wrap_brand_set textarea[name=description]");
            var description = description_target.val();

            if (name.length < 1) {
                common_ops.tip("请输入符合规范的品牌名称", name_target);
            }
        })
    }
};


$(document).ready(function () {
    brand_set_ops.init();
});