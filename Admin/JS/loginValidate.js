function checkLength(string){
    if(string.length == 0 || string == null || string == ' '){
        return false;
    }else{
        return true;
    }
}

let flag_login = false;

function loginValidate(){
    let userName = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    console.log(userName);
    console.log(password);

    if(checkLength(userName) == false){
        flag_login = false;
        alert('Nhập tên đăng nhập');
    }else if(checkLength(password) == false){
        flag_login = false;
        alert('Nhập mật khẩu');   
    }

    if(flag_login == false){
        flag_login = true;
        return false;
    }else{
        return true;
    }
}
