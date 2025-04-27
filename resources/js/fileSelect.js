$('input').on('change', function () {
  var file = $(this).prop('files')[0];
  $('.select_image').text(file.name);
});


// $('input').on('change', function () {
//   //propを使って、file[0]にアクセスする
//   var file = $(this).prop('files')[0];
//   //text()で要素内のテキストを変更する
//   $('.select-image').text(file.name);
// });


// fileform.addEventListener("change", (e) => { 
  
// document.getElementById('form-image').addEventListener('change', function() {

//   console.log(document.getElementById('form-image'));

//   console.log('changeイベントが発生しました');

//   var fileName = this.value.split('\\').pop();

//     console.log(fileName);

//   document.querySelector('.select-image').innerHTML = fileName;
// });

// });