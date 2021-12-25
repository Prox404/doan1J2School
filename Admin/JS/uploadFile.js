const actualBtn = document.getElementById('item-image');

actualBtn.addEventListener('change', function(){
  document.getElementById('image-upload').innerHTML = this.files[0].name;
})