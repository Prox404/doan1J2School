
function validateFormSignUp() {
    var x = document.forms["signUp"]["name"].value;
    if (x == "") {
        alert("Tên không được để trống");
        return false;
    }
    var y = document.forms["signUp"]["email"].value;
    var atpos = y.indexOf("@");
    var dotpos = y.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=y.length) {
        alert("Email không hợp lệ");
        return false;
    }
    var z = document.forms["signUp"]["password"].value;
    if (z == "") {
        alert("Mật khẩu không được để trống");
        return false;
    }
    var a = document.forms["signUp"]["repassword"].value;
    if (a == "") {
        alert("Nhập lại mật khẩu");
        return false;
    }
    return true;
}
