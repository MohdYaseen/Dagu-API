$('.second input').hide();
  $('.second button').hide();
  $('.first input').show();
  $('.first button').show();
  $('.third input').hide();
  $('.third button').hide();
  $('#step1').on('click',function(){
  $('.first').attr("class","step-circle first active");
  $('.second').attr("class","step-circle second");
  $('.third').attr("class","step-circle third");
  $('#step1').attr("class","btn btn-rounded btn-lg btn-primary");
  $('#step2').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('#step3').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('.second input').hide();
  $('.second button').hide();
  $('.first input').show();
  $('.first button').show();
  $('.third input').hide();
  $('.third button').hide();
  });
  
  $('#step2').on('click',function(){
  $('.first').attr("class","step-circle first ");
  $('.second').attr("class","step-circle second active");
  $('.third').attr("class","step-circle third");
  $('#step2').attr("class","btn btn-rounded btn-lg btn-primary");
  $('#step1').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('#step3').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('.first input').hide();
  $('.first button').hide();
  $('.third input').hide();
  $('.third button').hide();
  $('.second input').show();
  $('.second button').show();
  });
  $('#step3').on('click',function(){
  $('.first').attr("class","step-circle first");
  $('.second').attr("class","step-circle second");
  $('.third').attr("class","step-circle third active");
  $('#step3').attr("class","btn btn-rounded btn-lg btn-primary");
  $('#step2').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('#step1').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('.first input').hide();
  $('.first button').hide();
  $('.third input').show();
  $('.third button').show();
  $('.second input').hide();
  $('.second button').hide();
  });
  
  
  $('#btn_step1').on('click',function(){
  $('.first').attr("class","step-circle first ");
  $('.second').attr("class","step-circle second active");
  $('.third').attr("class","step-circle third");
  $('#step2').attr("class","btn btn-rounded btn-lg btn-primary");
  $('#step1').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('#step3').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('.first input').hide();
  $('.first button').hide();
  $('.third input').hide();
  $('.third button').hide();
  $('.second input').show();
  $('.second button').show();
  });
  
  $('#btn_step2').on('click',function(){
$('.first').attr("class","step-circle first");
  $('.second').attr("class","step-circle second");
  $('.third').attr("class","step-circle third active");
  $('#step3').attr("class","btn btn-rounded btn-lg btn-primary");
  $('#step2').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('#step1').attr("class","btn btn-rounded btn-lg btn-outline-primary");
  $('.first input').hide();
  $('.first button').hide();
  $('.third input').show();
  $('.third button').show();
  $('.second input').hide();
  $('.second button').hide();
  });
  
   $(window).scroll(function(){
      var header = $('#wrap'),
          scroll = $(window).scrollTop();         

      if (scroll >= 510) {
        header.addClass('fixed').fadeIn('slow');
      } else {
        header.removeClass('fixed');
      }

      if (scroll <= 1210 && scroll >= 510) {
        header.addClass('fixed').fadeIn('slow');
      } else {
        header.removeClass('fixed');
      }
  });
  
  /*FAQs*/
  $(function() {
  $(".expand").on( "click", function() {
    // $(this).next().slideToggle(200);
    $expand = $(this).find(">:first-child");
    
    if($expand.text() == "+") {
      $expand.text("-");
    } else {
      $expand.text("+");
    }
  });
});

  var acc = document.getElementsByClassName("accordion");
var i;

function click_action(){
  $('.accordion').removeClass('active');
  $('.panel').removeClass('show');

  this.classList.toggle("active");
  this.nextElementSibling.classList.toggle("show");
}

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = click_action;
}


function emtyCart()
{
  toastr.info('Your cart is empty',{timeOut: 5000})
  //toastr.options.positionClass = "toast-top-center";
}