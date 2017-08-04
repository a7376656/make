
$(function () {

  /* tab */
  $('.tab li').on('click', function () {
    var $this = $(this),
        index = $this.index();
    $this.addClass('active').siblings('li').removeClass('active');

    $('.tab-container .tab-content').eq(index).addClass('selected').siblings('.tab-content').removeClass('selected');
  });

  $('#slide-toggle').on('click', function () {
    $('#select-theme').slideToggle();
    $(this).text(function(i, text){
      return text === '隐藏' ? '显示风格主题' : '隐藏';
    })
  });

});