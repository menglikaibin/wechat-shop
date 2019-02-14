
var user_reset_pwd_ops = {
  init:function () {
      this.eventBind();
  },
  eventBind:function () {
      $("#save").click(function () {
          var btn_target = $(this);
          if (btn_target.hasClass("disabled")) {
              common_ops.alert("正在处理,请稍后");
              return false;
          }

          var old_pwd = $("#old_password").val();
          var new_pwd = $("#new_password").val();

          if (old_pwd.length < 1) {
              common_ops.tip("请输入原密码", $("#old_password"));
          }

          if (new_pwd.length < 6) {
              common_ops.tip("请输入一个不小于6位数的新密码", $("#new_password"));
          }

          btn_target.addClass("disabled");

          $.ajax({
              url:common_ops.buildWebUrl('/user/reset-pwd'),
              type:'POST',
              data:{
                  old_password:old_pwd,
                  new_password:new_pwd
              },
              dataType:'json',
              success: function (res) {
                  callback = null;

                  btn_target.removeClass("disabled");
                  if (res.code == 200) {
                      callback = function () {
                          window.location.reload();
                      };
                  }

                  common_ops.alert(res.msg, callback);
              },
              error: function (res) {
                  console.log(res);
              }
          })

      });
  }
};

$(document).ready(function () {
    user_reset_pwd_ops.init();
});

