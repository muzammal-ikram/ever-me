function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr("data-link")).select();
    document.execCommand("copy");
    $temp.remove();

    $(".tooltiptext").css('visibility','visible');
    setTimeout(function() {
        $(".tooltiptext").css('visibility','hidden');
    }, 2000);
  }

  ///user profile on click autofille property host form
  $(".property_user_account").on('change',function(){
      if(this.checked){
        $("#host_name").val(name);
        $("#host_phone").val(phone);
      }else{
        $("#host_name").val('');
        $("#host_phone").val('');
      }
  })

  ///////////////////////////////////////////////Section//////////////////////////////////////////////////

    ////////Delete the section//////////////
    function deleteSection(id){
      $("#deleteModal").modal('show');
      $("#delete_id").val(id);
      $("#delete_url").val('/section');
    }
    ////////Delete the section//////////////
    function deleteSectionInfo(id){
        $("#deleteModal").modal('show');
        $("#delete_id").val(id);
        $("#delete_url").val('/section-info');
    }
    ///for dynamic content
    $(".sections_list").on("click",".dynamic_content",function(e) {
      e.preventDefault();
      $(this).siblings('a.active').removeClass("active");
      $(this).addClass("active");
      var index = $(this).index();
      $("#dynamic_content>div.bhoechie-tab-content").removeClass("active");
      $("#dynamic_content>div.bhoechie-tab-content").eq(index).addClass("active");
  });
  //for edit case
  $(".sections_list").on("click",".load_content",function(e) {
    e.preventDefault();
    $(this).siblings('a.active').removeClass("active");
    $(this).addClass("active");
    $("#dynamic_content>div.bhoechie-tab-content").removeClass("active");
    var section_id = $(this).data('id');
    loadContent(section_id);

    var index = $(this).index();
    $("#dynamic_content>div.bhoechie-tab-content").removeClass("active");
    $("#dynamic_content>div.bhoechie-tab-content").eq(index).addClass("active");
});

///edit the section title
$(".sections_list").on("click",".edit_case",function(e) {
    e.preventDefault();
    $(this).siblings('a.active').removeClass("active");
    $(this).addClass("active");
    $("#dynamic_content>div.bhoechie-tab-content").removeClass("active");
    var section_id = $(this).data('id');
    var url = $(this).data('url');
    openEditSectionModal(section_id,url);

    var index = $(this).index();
    $("#dynamic_content>div.bhoechie-tab-content").removeClass("active");
    $("#dynamic_content>div.bhoechie-tab-content").eq(index).addClass("active");
});


    ///show image or video field
 

    document.addEventListener("DOMContentLoaded", function(){
        $(".first_section").trigger('click');
        $('.sections_list h4').on('click', function(){
            $('.sections_list h4').removeClass('current');
            $(this).addClass('current');
        });
    });
    $('.sections_list h4').on('click', function(){
        $('.sections_list h4').removeClass('current');
        $(this).addClass('current');
    });



    // property image + host image
    function HandleBrowseClick(input_image)
    {
      var fileinput = document.getElementById(input_image);
      fileinput.click();
    }
////////////////////////////////////////////////////////////////////////////////

    $(document).ready(function() {
      $('#host_platform').select2();
    });
////////////////////////////////////////////////////////////////////////////////

    $('.dataTables_filter input[type="search"]').css(
      {'width':'350px','display':'inline-block'}
   );
////////////////////////////////////////////////////////////////////////////////

    var allEditors = document.querySelectorAll('.ckeditor');
    for (var i = 0; i < allEditors.length; ++i) {
      ClassicEditor.create(
          allEditors[i],
          {
              removePlugins: ['ImageUpload']
          }
      );
    }

//////////////////////////////////////////////////////////////////////////////  

$(document).on('change', '.add_video', function () {
  var id = $(this).data("video-id");
  
  if ($(this).is(':checked')){
    $("#video-div"+id).hide();
    $("#image-div"+id).show();
    $("label[for='customSwitch2']").text('Switch to video');
  }else{
    $("#image-div"+id).hide();
    $("#video-div"+id).show();
    $("label[for='customSwitch2']").text('Switch to image');

  }

});

///////////////////////////////////////////////////////////////////////////////////

$('.confirm_delete').on('click', function (event) {
  event.preventDefault();
  const url = $(this).attr('href');
  swal({
      title: 'Are you sure?',
      text: 'You want to delete',
      icon: 'warning',
      buttons: ["Cancel", "Yes!"],
  }).then(function(value) {
      if (value) {
          window.location.href = url;
      }
  });
});
///////////////////////////////////////////////////////////////////////////////////

$( ".dragable" ).sortable({
  items: "li",
  cursor: 'move',
  opacity: 0.6,
  update: function() {
      sendOrderToServer();
  }
});

function sendOrderToServer() {
  var order = [];
  var token = $('meta[name="csrf-token"]').attr('content');
  $('li.row1').each(function(index,element) {
    order.push({
      id: $(this).attr('data-id'),
      position: index+1
    });
  });

  $.ajax({
    type: "POST", 
    url: "/section-sortable",
      data: {
      order: order,
      _token: token
    },
    success: function(response) {
        if (response.status == "success") {
          console.log(response);
        } else {
          console.log(response);
        }
    }
  });
}