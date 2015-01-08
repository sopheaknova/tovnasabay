

(function($)
{
	
  /*--------------------------------------------------------------------------------------*/
  /*  Primary navigation
  /*--------------------------------------------------------------------------------------*/
  $( 'ul.primary-nav li' ).each(function(){
    var submenu = $(this).find('ul:first');
    $(this).hover(function(){
      submenu.stop().slideDown(250, function(){
                                      $(this).css({overflow:"visible", height:"auto"});
                                    });
    }, function(){
      submenu.stop().slideUp(250, function(){ 
                                      $(this).css({overflow:"hidden", display:"none"});
                                    });
    });
  });

  /*--------------------------------------------------------------------------------------*/
  /*  Make all the videos responsive with FitVids - http://fitvidsjs.com/         
  /*--------------------------------------------------------------------------------------*/
  $('#content').fitVids();

  /*--------------------------------------------------------------------------------------*/
  /*  Magnific Popup        
  /*--------------------------------------------------------------------------------------*/
  $('.video-trailer').magnificPopup({
      type: 'iframe',
      preloader: false,
      removalDelay: 500,
      mainClass: 'mfp-fade',
      fixedContentPos: false
  });

  /*--------------------------------------------------------------------------------------*/
  /*  Toggle between cinemas video trailer and map with location       
  /*--------------------------------------------------------------------------------------*/
  $(window).load(function () {
      $('.map').addClass('map-hide');
  })
  $('#map-switch').click(function(ev){
      ev.preventDefault();

      $('.video-trailer').slideToggle(500);
      $('.map').slideToggle(500);

      $('.show-map').toggle();
      $('.show-video').toggle();
      $(this).blur();
  });

  /*--------------------------------------------------------------------------------------*/
  /*  Init Comments Reply Script         
  /*--------------------------------------------------------------------------------------*/
  addComment = {
    moveForm : function(commId, parentId, respondId, postId) {
      var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');

      if ( ! comm || ! respond || ! cancel || ! parent )
        return;

      t.respondId = respondId;
      postId = postId || false;

      if ( ! t.I('wp-temp-form-div') ) {
        div = document.createElement('div');
        div.id = 'wp-temp-form-div';
        div.style.display = 'none';
        respond.parentNode.insertBefore(div, respond);
      }

      //comm.parentNode.insertBefore(respond, comm.nextSibling);
      if ( post && postId )
        post.value = postId;
      parent.value = parentId;
      cancel.style.display = '';

      $('html,body').animate({scrollTop: $('#reply-title').offset().top}, 500, 'easeInQuad');

      cancel.onclick = function() {
        var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

        if ( ! temp || ! respond )
          return;

        t.I('comment_parent').value = '0';
        temp.parentNode.insertBefore(respond, temp);
        temp.parentNode.removeChild(temp);
        this.style.display = 'none';
        this.onclick = null;
        return false;
      }

      try { t.I('comment').focus(); }
      catch(e) {}

      return false;
    },

    I : function(e) {
      return document.getElementById(e);
    }
  }

  var commentform=$('#comment-form'); 
  commentform.prepend('<div id="comment-status"></div>'); 
  var statusdiv=$('#comment-status');
   
  commentform.submit(function(){

    var formdata=commentform.serialize();
    statusdiv.html('<p>' + theme_objects.commentProcess + '</p>');
    var formurl=commentform.prop('action');

    $.ajax({
      type: 'post',
      url: formurl,
      data: formdata,
      error: function(XMLHttpRequest, textStatus, errorThrown){
        statusdiv.html('<p class="wdpajax-error">' + theme_objects.commentError + '</p>');
      },
      success: function(data, textStatus){
        //if(data=="success")
        statusdiv.html('<p class="ajax-success">' + theme_objects.commentSuccess + '</p>');
        //else
        //statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
        //commentform.find('textarea[name=comment]').val('');
      }
    });

    return false;
   
  });



}(jQuery));