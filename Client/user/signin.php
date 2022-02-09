<div id="modal-signin" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content login-form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <img src="https://i.ibb.co/6bZRxw4/P-ogrange.png" alt="" class="login-logo" />
                <h1 class="login-title"> Welcome</h1>
                <h1 class="login-title orange"> Prox Shopping Services</h1>
            </div>
            <form method="POST" id="signin-form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" />
                <label for="pass">Mật khẩu:</label>
                <input type="password" name="password" id="pass" placeholder="Mật khẩu" />
                <br>
                <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />

                <p class="form-bottom-text">Chưa có tài khoản ? <a href="#" class="signup-button">Đăng ký</a></p>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // validate signup form on keyup and submit
        $("#signin-form").validate({
            rules: {
                "email": {
                    required: true,
                    email: true,
                    maxlength: 50,
                },
                "password": {
                    required: true,
                    minlength: 8,
                }
            },
            messages: {
                "email": {
                    required: "Vui lòng nhập email",
                    email: "Email không hợp lệ",
                    maxlength: "Email không hợp lệ",
                },
                "password": {
                    required: "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu phải có ít nhất 8 ký tự",
                }
            },
            submitHandler: function(form) {
                $.ajax({
                        url: "./user/process_signin.php",
                        type: "POST",
                        data: $(form).serializeArray(),
                    })
                    .done(function(response) {
                        if (response == 1) {
                            alert("Đăng nhập thành công");
                            location.reload();
                        } else {
                            alert(response);
                        }
                    });
            }
        });
    });

    $(".signup-button").click(function(){
        // change modal
        $("#modal-signin").modal("hide");
        $("#modal-signup").modal("show");

    });
  
</script>