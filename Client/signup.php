<div id="modal-signup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content login-form">
            <div class="modal-header">
                <img src="https://i.ibb.co/6bZRxw4/P-ogrange.png" alt="" class="login-logo" />
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="login-title"> Welcome</h1>
                <h1 class="login-title orange"> Prox Shopping Services</h1>
            </div>
            <form method="POST" id="signup-form">
                <label for="name">Tên:</label>
                <input type="text" name="name" id="name" placeholder="Họ và tên" />

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" />

                <label for="pass">Mật khẩu:</label>
                <input type="password" name="password" id="password" placeholder="Mật khẩu" />

                <label for="re-pass">Nhập lại mật khẩu:</label>
                <input type="password" name="re-password" id="re-password" placeholder="Nhập lại mật khẩu" />
                <br>
                <input type="submit" id="signup" class="form-submit" value="Đăng ký" />
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // validate signup form on keyup and submit
        $("#signup-form").validate({
            rules: {
                "name": {
                    required: true,
                    validName: true,
                    maxlength: 15
                },
                "email": {
                    required: true,
                    validEmail: true,
                    email: true,
                    maxlength: 50,
                    remote: {
                        url: "check_email.php",
                        type: "post",
                        data: {
                            email: function() {
                                return $("#email").val();
                            }
                        }
                    }
                },
                "password": {
                    required: true,
                    minlength: 8,
                    validPassword: true
                },
                "re-password": {
                    equalTo: "#password",
                    minlength: 8

                }
            },
            messages: {
                "name": {
                    required: "Vui lòng nhập tên",
                    validName: "Tên không được chứa ký tự đặc biệt",
                    maxlength: "Hãy nhập tối đa 15 ký tự"
                },
                "email": {
                    required: "Vui lòng nhập email",
                    validEmail: "Email không đúng định dạng",
                    email: "Email không hợp lệ",
                    maxlength: "Hãy nhập tối đa 50 ký tự",
                    remote: "Email đã tồn tại"
                },
                "password": {
                    required: "Vui lòng nhập password",
                    minlength: "Hãy nhập ít nhất 8 ký tự",
                    validPassword: "Password không được chứa ký tự đặc biệt"
                },
                "re-password": {
                    equalTo: "Hai password phải giống nhau",
                    minlength: "Hãy nhập ít nhất 8 ký tự"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                        url: 'process_signup.php',
                        type: 'POST',
                        dataType: "json",
                        data: $(form).serializeArray(),
                    })
                    .done(function(response) {
                        if (response === 1) {
                            //reload page
                            // location.reload();
                        }
                    });
            }
        });
    });
</script>