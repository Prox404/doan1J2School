const actualBtn = document.getElementById('item-image');

actualBtn.addEventListener('change', function(){
  document.getElementById('image-upload').innerHTML = this.files[0].name;
})

function checkLength(string){
    if(string.length == 0 || string == null || string == ' '){
        return false;
    }else{
        return true;
    }
}

let flag = true;

function validate(){
    let name = document.getElementById('item-name').value;
    let cost = document.getElementById('item-cost').value;
    let description = document.getElementById('item-information').value;
    let numberOfItem = document.getElementById('number-of-item').value;

    console.log(name);

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

