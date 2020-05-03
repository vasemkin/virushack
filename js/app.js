function filterContent() {
    el = document.getElementsByClassName('courses__wrapper');
    el[0].innerHTML = '';
    form = $('.courses__area');
    data = form.serialize();
    $.ajax({
        url: "ajax/coursesContent.php",
        type: "POST",
        dataType: "html",
        data: data,
        success: function(data){
          el[0].innerHTML = data;
        }
      });
}