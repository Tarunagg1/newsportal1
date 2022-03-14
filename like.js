$(document).ready(function(){
    $('.likebtn').on('click',function(){
       var pid = $(this).data('id')
      $clickbtn = $(this);
      if($clickbtn.hasClass('fa-thumbs-o-up')){
          action = "like";
      }else if($clickbtn.hasClass('fa-thumbs-up')){
          action = "unlike";
      }
      $.ajax({
          url: "like1.php",
          type:"post",
          data:{'action':action,'postid':pid},
          success:function(data){
              res = JSON.parse(data);
              if(action='like'){
                  $clickbtn.removeClass('fa-thumbs-o-up');
                  $clickbtn.addClass('fa-thumbs-up')
              }else if(action = 'unlike'){
                $clickbtn.removeClass('fa-thumbs-up')
                $clickbtn.addClass('fa-thumbs-o-up');
              }
              $clickbtn.siblings('span.like').text(res.likes);
              $clickbtn.siblings('span.dislike').text(res.dislike);
              $clickbtn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
          }
      })
    });


    // dislike

    $('.dislikebtn').on('click',function(){
        var pid = $(this).data('id')
       $clickbtn = $(this);
       if($clickbtn.hasClass('fa-thumbs-o-down')){
           action = "dislike";
       }else if($clickbtn.hasClass('fa-thumbs-down')){
           action = "undislike";
       }
       $.ajax({
           url: "like1.php",
           type:"post",
           data:{'action':action,'postid':pid},
           success:function(data){
               res = JSON.parse(data);
               if(action='dislike'){
                   $clickbtn.removeClass('fa-thumbs-o-down');
                   $clickbtn.addClass('fa-thumbs-down')
               }else if(action = 'undislike'){
                   $clickbtn.removeClass('fa-thumbs-down')
                   $clickbtn.addClass('fa-thumbs-o-down');
               }
               $clickbtn.siblings('span.like').text(res.likes);
               $clickbtn.siblings('span.dislike').text(res.dislike);
               $clickbtn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
           }
       })
     });
})


