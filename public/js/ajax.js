$body = $("body");

function loadContent(section_id=null) {
   $body.addClass("loading");
    $.ajax({
       type:'GET',
       url:'/get/content',
       data : {"section_id" : section_id},
       dataType: 'HTML',
       success:function(data) {
         $body.removeClass("loading");
          $("#dynamic_content").html(data);
       },
       error: function(data) {
         $body.removeClass("loading");
           console.log(data);
           $("#dynamic_content").html('');
       }
    });
 }

     ///update section
     $(document).on('click', '#UpdateForm', function () {
      $body.addClass("loading");
      CKEDITOR.instances.exampleFormControlTextarea1.updateElement();
      var form = $('#updateSection')[0];
      var formData = new FormData(form);
      $.ajax({
          url: $('#updateSection').attr('action'),
          type: 'POST',
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          success: function(result) {
              location.reload();

          },
          error: function(data) {
            $body.removeClass("loading");
              console.log(data);

          }
      });
  });

   // add new dynamic tab
   function addNewTab(sectionId){
      $body.addClass("loading");
      $.ajax({
        url: '/load/section_tab',
        type: 'GET',
        dataType: 'HTML',
        data:{'section_id' : sectionId},
        success: function(result) {
         $body.removeClass("loading");
            $("#tablist").append(result);
        },
        error: function(data) {
         $body.removeClass("loading");
            console.log(data);
        }
    });
}

//load tab content
function loadSectionInfoTabContent(id){
   $body.addClass("loading");
    $.ajax({
      url: '/info_section_tab/content',
      type: 'GET',
      dataType: 'HTML',
      data:{'id' : id},
      success: function(result) {
         $body.removeClass("loading");
          $("#dynamic_section_tab").html(result);
      },
      error: function(data) {
         $body.removeClass("loading");
          console.log(data);
          $("#dynamic_section_tab").html('');
      }
  });
}



///load the section content
function openEditSectionModal(section_id,url) {
    $body.addClass("loading");
     $.ajax({
        type:'GET',
        url: url,
        dataType: 'HTML',
        success:function(data) {
          $body.removeClass("loading");
            $("#edit_modal_section").modal('show');
            $("#edit_modal_section .modal-body").html(data);
        },
        error: function(data) {
          $body.removeClass("loading");
            console.log(data);
        }
     });
  }
     ///update section information
     $(document).on('click', '#updateSectionInfo', function () {
      $body.addClass("loading");
      CKEDITOR.instances.exampleFormControlTextarea1.updateElement();
      
      var form = $('#updateSectionInformation')[0];
      var formData = new FormData(form);

      $.ajax({
          url: $('#updateSectionInformation').attr('action'),
          type: 'POST',
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          success: function(data) {
            $body.removeClass("loading");
          },
          error: function(data) {
            $body.removeClass("loading");
            console.log(data);
          }
      });
  });


    // delete the content
    function deleteContent(id){
      $body.addClass("loading");
      var token = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
         url:  $("#delete_url").val(),
         type: 'DELETE',
         data:{'id' : $("#delete_id").val(),
         "_method": 'DELETE',
         "_token": token},
         success: function(result) {
            $body.removeClass("loading");
            location.reload();
         },
         error: function(data) {
            $body.removeClass("loading");
             console.log(data);
         }
     });
   }
