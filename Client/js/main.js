let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}


function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}


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
