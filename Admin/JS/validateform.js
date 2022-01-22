function checkLength(string){
    if(string.length == 0 || string == null || string == ' '){
        return false;
    }else{
        return true;
    }
}

function check_gender(genderArray){
    let check = false;
    for(i = 0 ;  i < genderArray.length ; i++){
        if(genderArray[i].checked){
           check = true;
        }
    }
    return check;
}

function check_name(name){
    let regex_name = /^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/;
    if(!regex_name.test(name)){
        return false;
    }else{
        return true;
    }
}

function check_password(password){
    let passwordStrongRegex = /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*(?=.*[0-9]).*$/gm;
    if(!passwordStrongRegex.test(password)){
        return false;
    }else{
        return true;
    }
}

function check_phone(phone){
    let phoneRegex = /^[0-9\-\+]{9,15}$/;
    if(!phoneRegex.test(phone)){
        return false;
    }else{
        return true;
    }
}

let flag = true;

function validate_add_product(){
    let name = document.getElementById('item-name').value;
    let cost = document.getElementById('item-cost').value;
    let description = document.getElementById('item-information').value;
    let numberOfItem = document.getElementById('number-of-item').value;
    let manufacturer = document.getElementById('manufacturer');
    let photo = document.getElementById("item-image").files;

    if(checkLength(name) == false){
        flag = false;
        alert('Nhập tên mặt hàng');
    }else if(checkLength(cost) == false){
        flag = false;
        alert('Nhập giá mặt hàng');
    }else if(isNaN(cost)){
        flag = false;
        alert('Gía phải là số');
    }else if(checkLength(description) == false){
        flag = false;
        alert('Nhập mô tả mặt hàng');
    }else if(photo.length == 0){
        flag = false;
        alert('Chưa tải file ảnh lên!');
    }else if(checkLength(numberOfItem) == false){
        flag = false;
        alert('Nhập số lượng mặt hàng');
    }else if(isNaN(numberOfItem)){
        flag = false;
        alert('Số lượng phải là số');
    }else if(numberOfItem <= 0){
        flag = false;
        alert('Số lượng phải lớn hơn 0');
    }else if(manufacturer.value == 0){
        flag = false;
        alert('Chọn nhà sản xuất');
    }

    if(flag == false){
        flag = true;
        return false;
    }else{
        return true;
    }
}
function validate_edit(){
    let name = document.getElementById('item-name').value;
    let cost = document.getElementById('item-cost').value;
    let description = document.getElementById('item-information').value;
    let numberOfItem = document.getElementById('number-of-item').value;
    let manufacturer = document.getElementById('manufacturer');
    let photo = document.getElementById("item-image").files;

    if(checkLength(name) == false){
        flag = false;
        alert('Nhập tên mặt hàng');
    }else if(checkLength(cost) == false){
        flag = false;
        alert('Nhập giá mặt hàng');
    }
    else if(checkLength(description) == false){
        flag = false;
        alert('Nhập mô tả mặt hàng');
    }else if(checkLength(numberOfItem) == false){
        flag = false;
        alert('Nhập số lượng mặt hàng');
    }

    if(flag == false){
        flag = true;
        return false;
    }else{
        return true;
    }
}
function validate_add_employee(){
    let name = document.getElementById('employee_name').value;
    let phone = document.getElementById('employee_phone_number').value;
    let address = document.getElementById('employee_address').value;
    let gender = document.getElementsByName('employee_gender');
    let dob = document.getElementById('employee_dob');
    let email = document.getElementById('employee_email').value;
    let password = document.getElementById('employee_password').value;


    if(checkLength(name) == false){
        flag = false;
        alert('Nhập tên nhân viên');
    }else if(check_name(name) == false){
        flag = false;
        alert('Tên không hợp lệ !');
    }else if(checkLength(phone) == false){
        flag = false;
        alert('Nhập số điện thoại');
    }
    else if(checkLength(address) == false){
        flag = false;
        alert('Nhập địa chỉ');
    }else if(check_gender(gender) == false){
        flag = false;
        alert('Chọn giới tính');
    }else if(checkLength(dob) == false){
        flag = false;
        alert('Nhập ngày sinh');
    }else if(checkLength(email) == false){
        flag = false;
        alert('Nhập email');
    }else if(checkLength(password) == false){
        flag = false;
        alert('Nhập mật khẩu');
    }else if(check_password(password) == false){
        flag = false;
        alert('Mật khẩu khum hợp lệ\nMật khẩu hợp lệ phải có ít nhất: \n8 kí tự ,\n1 chữ số, \nmột kí tự tin hoa, \nvà một kí tự đặc biệt');
    }
        

    if(flag == false){
        flag = true;
        return false;
    }else{
        return true;
    }
}

function oku_check(){
    let name = document.getElementById('item-name').value;
    let cost = document.getElementById('item-cost').value;
    let description = document.getElementById('item-information').value;
    let numberOfItem = document.getElementById('number-of-item').value;

    if(checkLength(name) == true){
        document.getElementById('item-name').style.border = "2px solid orange";
    }else{
        document.getElementById('item-name').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(cost) == true){
        document.getElementById('item-cost').style.border = "2px solid orange";
    }else{
        document.getElementById('item-cost').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(description) == true){
        document.getElementById('item-information').style.border = "2px solid orange";
    }else{
        document.getElementById('item-information').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(numberOfItem) == true){
        document.getElementById('number-of-item').style.border = "2px solid orange";
    }else{
        document.getElementById('number-of-item').style.border = "2px solid #d1d1d1";
    }
}
function oku_add_check(){
    let name = document.getElementById('employee_name').value;
    let phone = document.getElementById('employee_phone_number').value;
    let address = document.getElementById('employee_address').value;
    let dob = document.getElementById('employee_dob');
    let email = document.getElementById('employee_email').value;
    let password = document.getElementById('employee_password').value;

    if(checkLength(name) == true && check_name(name) == true){
        document.getElementById('employee_name').style.border = "2px solid orange";
    }else{
        document.getElementById('employee_name').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(phone) == true){
        document.getElementById('employee_phone_number').style.border = "2px solid orange";
    }else{
        document.getElementById('employee_phone_number').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(address) == true){
        document.getElementById('employee_address').style.border = "2px solid orange";
    }else{
        document.getElementById('employee_address').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(dob) == true){
        document.getElementById('employee_dob').style.border = "2px solid orange";
    }else{
        document.getElementById('employee_dob').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(email) == true){
        document.getElementById('employee_email').style.border = "2px solid orange";
    }else{
        document.getElementById('employee_email').style.border = "2px solid #d1d1d1";
    }
    if(checkLength(password) == true){
        document.getElementById('employee_password').style.border = "2px solid orange";
    }else{
        document.getElementById('employee_password').style.border = "2px solid #d1d1d1";
    }
}

function oku_check_add_manufacturer(){
    let name = document.getElementById('manufacturer_name').value;

    if(checkLength(manufacturer_name) == true){
        document.getElementById('manufacturer_name').style.border = "2px solid orange";
    }else{
        document.getElementById('manufacturer_name').style.border = "2px solid #d1d1d1";
    }

}

function add_manufacturer_validate() {
    let manufacturer_name = document.getElementById('manufacturer_name').value;

    if(checkLength(manufacturer_name) == false){
        flag = false;
        alert('Nhập tên nhà sản xuất');
    }
    
    if(flag == false){
        flag = true;
        return false;
    }else{
        return true;
    }
}

function checkResetPassword(){
    let password = document.getElementById('password').value;
    let re_password = document.getElementById('re_password').value;

    if(checkLength(password) == false){
        flag = false;
        alert('Nhập mật khẩu');
    }else if(check_password(password) == false){
        flag = false;
        alert('Mật khẩu khum hợp lệ\nMật khẩu hợp lệ phải có ít nhất: \n8 kí tự ,\n1 chữ số, \nmột kí tự tin hoa, \nvà một kí tự đặc biệt');
    }else if(checkLength(re_password) == false){
        flag = false;
        alert('Nhập lại mật khẩu !');
    }else if(password != re_password){
        flag = false;
        alert('Mật khẩu nhập lại không khớp !');
    }

    if(flag == false){
        flag = true;
        return false;
    }else{
        return true;
    }
}
