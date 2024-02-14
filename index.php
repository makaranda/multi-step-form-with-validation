<!DOCTYPE html>
<html>
<head>
<title>Multi Forms</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .form-section{
    display: none;
  }
  .form-section.current{
    display: inline;
  }
  .parsley-errors-list{
    color: red;
  }
  
</style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-12 mt-4">
      <h1 class="text-center text-danger">Multi-Step Form</h1>
      <div class="nav nav-fill mb-4 mt-4">
         <label for="" class="nav-link shadow-sm step-lists step0 border ml-2">
           Step One
         </label>
         <label for="" class="nav-link shadow-sm step-lists step1 border ml-2">
           Step Two
         </label>
         <label for="" class="nav-link shadow-sm step-lists step2 border ml-2">
           Step Three
         </label>
      </div>
        <form action="/action_page.php" method="POST" class="employee-form">
            
         <div class="form-section">
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Name:</label>
              <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name:</label>
              <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required>
            </div>
          </div>

          <div class="form-section">
            <div class="mb-3 mt-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone:</label>
              <input type="tel" class="form-control" id="phone" placeholder="Enter password" name="phone" required>
            </div>
          </div>


          <div class="form-section">
            <div class="mb-3 mt-3">
              <label for="address" class="form-label">Address:</label>
              <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required>
            </div>
            <div class="mb-3">
              <label for="website" class="form-label">Website:</label>
              <input type="text" class="form-control" id="website" placeholder="Enter website" name="website" required>
            </div>
          </div>

           <div class="form-navigation mt-3">
              <button type="button" class="previous btn btn-warning float-left">Previous</button>
              <button type="button" class="next btn btn-primary float-right">Next</button>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
           </div>
        </form>      
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
// $(document).ready(function(){
//   alert();
//  });

$(function(){
  var $sections=$('.form-section');
  var page_type = 'current';
  
  function navigateTo(index,pageType){

    $sections.removeClass('current').eq(index).addClass('current');

    $('.form-navigation .previous').toggle(index>0);
    var atTheEnd = index >= $sections.length - 1;
    $('.form-navigation .next').toggle(!atTheEnd);
    $('.form-navigation [Type=submit]').toggle(atTheEnd);

    const step = document.querySelector('.step'+index);
    //alert(index+''+pageType);
    step.style.backgroundColor = "#1786b8";
    step.style.color = "#fff";

    if(index == 0 && pageType == 'previous'){

      $('.step1').css({'background-color':'#fff','color':'#0d6efd'});
      $('.step2').css({'background-color':'#fff','color':'#0d6efd'});

    }else if(index == 1 && pageType == 'previous'){

      $('.step2').css({'background-color':'#fff','color':'#0d6efd'});

    }else{
      step.style.backgroundColor = "#1786b8";
      step.style.color = "white";
    }
    
  }

  function curIndex(){
    return $sections.index($sections.filter('.current'));
  }

  $('.form-navigation .previous').click(function(){
    page_type = 'previous';
    navigateTo(curIndex() - 1,page_type);
  });

  $('.form-navigation .next').click(function(){
    $('.employee-form').parsley().whenValidate({
      group:'block-'+curIndex()
    }).done(function(){
      page_type = 'next';
      navigateTo(curIndex() + 1,page_type);
    });     
  });

  $sections.each(function(index,section){
     $(section).find(':input').attr('data-parsley-group','block-'+index);
  });

  navigateTo(0,page_type);

});
</script>
</body>
</html>