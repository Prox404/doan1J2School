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

let flag = true;

function validate(){
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
    }else if(photo.length == 0){
        flag = false;
        alert('Chưa tải file ảnh lên!');
    }else if(checkLength(numberOfItem) == false){
        flag = false;
        alert('Nhập số lượng mặt hàng');
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

    if(checkLength(name) == true){
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