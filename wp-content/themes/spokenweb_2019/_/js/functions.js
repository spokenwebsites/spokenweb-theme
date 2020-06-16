$(document).ready(function() {

  $('body').addClass("page-" + page);
  $('.fancybox').fancybox();

  $("body").fadeIn();

  if ($('.scroll-pane').index > -1) $('.scroll-pane').jScrollPane({
    contentWidth: '0px',
    autoReinitialise: true,
    autoReinitialiseDelay: 2000
  });

  if ($("body").hasClass('single-events')) $("#menu-item-20").addClass("current_page_item");
});



$('audio:not(".wp-audio-shortcode")').mediaelementplayer(/* Options */);

$(window).on('load', function() {
  $("#content").css({
    'opacity': '1'
  });
  $("body").removeClass("noscroll");
  $("#loader").remove();
});

function unique(list) {
  var result = [];
  $.each(list, function(i, e) {
    if ($.inArray(e, result) == -1) result.push(e);
  });
  return result;
}

$(document).ready(function() {
  $('aside h4 a[href*="#"').click(function(e) {
    e.preventDefault();
    $target = "#" + $(this).attr("href").split('#')[1];
    $("body").scrollTo($($target), 400, {
      offset: 0
    });
    $('aside h4').removeClass("active");
    $(this).parent().addClass("active");
  });


  $(window).scroll(function() {
    if ($(this).scrollTop() > $(window).height()) {
      $('#back-to-top').fadeIn();
    } else {
      $('#back-to-top').fadeOut();
    }
  });
  // scroll body to 0px on click
  $('#back-to-top').click(function() {
    $('#back-to-top').tooltip('hide');
    if (page == "symposia" || page == "institutes") $top = $symposium.parent().parent().offset().top - 20;
    else $top = 0;
    $(window).animate({
      scrollTop: $top
    }, 800);
    return false;
  });
  //$('#back-to-top').tooltip('show');

});

if (page == "spokenweblog_single") {
  $("#menu-main-menu").find(".current_page_parent").removeClass("current_page_parent");
  $("#menu-main-menu").find(".current-post-ancestor").addClass("current_page_parent");

}

if (page == "spokenweblog" || page=="audio-of-the-week") {

  $(".dropdown.filter a").click(function(e){
    e.preventDefault();
    if (! $(this).hasClass('active')) {
      $target = $(this).attr("href").replace("#","");
      $type = $(this).parent().parent().find("button").data("type");
      $(this).parent().find(".active").removeClass("active");
      $(this).addClass("active");
      if ($target==""){ $(this).parent().parent().find("button").text($(this).parent().parent().find("button").data("title"));
        $(".article").fadeOut();
        $(".article").fadeIn();
      } else {
        $(this).parent().parent().find("button").text($(this).text());
        $(".article").fadeOut();
        $(".article[data-"+$type+"="+$target+"]").fadeIn();
      }
    }
  });

  $(".dropdown.sort a").click(function(e){
    e.preventDefault();
    if (! $(this).hasClass('active')) {
      $target = $(this).attr("href").replace("#","");
      $type = $(this).parent().parent().find("button").data("type");
      $(this).parent().find(".active").removeClass("active");
      $(this).addClass("active");

      $(this).parent().parent().find("button").text($(this).text());
      $(".container.articles").fadeOut();
      $(".container.articles[data-"+$type+"="+$target+"]").fadeIn();
    }
  });

}


if (page == "symposia" || page == "institutes") {

  var toggleAffix = function(affixElement, wrapper, scrollElement) {

    var height = affixElement.outerHeight(),
      top = wrapper.offset().top - 20,
      footer = $("#footer").height(),
      bottom = top + height + footer,
      navbarHeight = 0;

    //console.log(scrollElement.scrollTop(), scrollElement.scrollTop()+height, height, top, bottom, navbarHeight, bottom + navbarHeight, $(window).height());

    //console.log(scrollElement.scrollTop() + height + footer, $(document).height() - footer);

    if (scrollElement.scrollTop() + height + footer > $(document).height() - footer) {
      affixElement.removeClass("affix");
      affixElement.addClass("affix-bottom");
      affixElement.css("top", $(document).height() - footer - height - 130);
    } else if (scrollElement.scrollTop() >= top) {
    //if (scrollElement.scrollTop() + $(window).height() + top >= bottom) {
      navbarHeight = 0;
      //wrapper.height(height);
      affixElement.css("top", "20px");
      affixElement.addClass("affix");
      affixElement.removeClass("affix-bottom");
    } else {
      navbarHeight = $("#navbar").parent().outerHeight() + $(".hero").outerHeight() + 75;
      affixElement.css("top", "0px");
      affixElement.removeClass("affix");
      affixElement.removeClass("affix-bottom");
      //wrapper.height('auto');
    }

    $(".sidebar-container").css("padding-top", navbarHeight + "px");


  };

  $('[data-toggle="affix"]').each(function() {
    var ele = $(this),
      wrapper = $('<div></div>');

    ele.before(wrapper);
    $(window).on('scroll resize', function() {
      toggleAffix(ele, wrapper, $(this));
    });

    // init
    toggleAffix(ele, wrapper, $(window));
  });


  function toggleSymposium(i, init) {
    $symposia = $("article .symposium");
    $symposium = $symposia.eq(i);
    $sidebar = $("aside");

    var postname = $symposium.attr("id");

    var title = $symposium.data('title');
    var event_date = $symposium.data('eventdate');
    var city = $symposium.data('city');
    var institution = $symposium.data('institution');
    var venue = $symposium.data('venue');
    var permalink = $symposium.data('permalink');

    var featuredImage = $symposium.data('img');

    $sidebar.find(".symposium-date").text(event_date);
    $sidebar.find(".symposium-title").html(title);
    $sidebar.find(".symposium-city").html(city);
    $sidebar.find(".symposium-institution").html(institution);

    if (typeof venue != "undefined" && venue != "") {
      $sidebar.find(".symposium-venue").parent().show();
      $sidebar.find(".symposium-venue").html(venue);
    } else {
      $sidebar.find(".symposium-venue").parent().hide();
    }

    $symposiumLinks = $sidebar.find(".symposium-links");
    $symposiumLinks.html('');

    $notableEvents = $symposium.find(".conf-notable-events");
    $schedule = $symposium.find(".conf-schedule");
    $participants = $symposium.find(".conf-participants");

    $travel = $symposium.find(".conf-participant-info-travel");
    $accommodations = $symposium.find(".conf-participant-info-accommodations");
    $activity = $symposium.find(".conf-participant-info-activity");

    if ($notableEvents && $notableEvents.length > 1) {
      $symposiumLinks.append('<h3><a href="#notableEvents' + i + '">Notable Events</a></h3>');
    }

    if ($schedule && $schedule.length > 1) {
      $symposiumLinks.append('<h3><a href="#schedule' + i + '">Conference Schedule</a></h3>');
    }

    if ($participants && $participants.length > 1) {
      $symposiumLinks.append('<h3><a href="#participants' + i + '">Participants</a></h3>');
    }

    if ($travel && $travel.length > 1) {
      $symposiumLinks.append('<h3><a href="#travel' + i + '">Travel</a></h3>');
    }
    if ($accommodations && $accommodations.length > 1) {
      $symposiumLinks.append('<h3><a href="#accommodations' + i + '">Accommodations</a></h3>');
    }
    if ($activity && $activity.length > 1) {
      $symposiumLinks.append('<h3><a href="#activity' + i + '">Things to do around the area</a></h3>');
    }

    $symposiumLinks.find('a').click(function(e) {
      e.preventDefault();
      //console.log(e.target.hash);
      //$(window).scrollTo(e.target.hash, 400);
      $(window).animate({
        scrollTop: $(e.target.hash).offset().top - 20
      }, 800);

    });

    $hero = $("#hero");

    $hero.css("background-image", "url(" + featuredImage + ")");

    $symposia.hide();
    $symposium.show();

    if ($(".sidebar-container").hasClass("affix")) $(window).scrollTop($symposium.parent().parent().offset().top-20);

    //FB.XFBML.parse($symposium.find(".event-share .fb-share-button-container")[0]);

    permalink = window.location;

    $symposium.find('.event-share .fb-share-button-container').html('<div class="fb-share-button" data-href="' + permalink + '" data-layout="button" data-size="large" data-mobile-iframe="true"></div>');

    FB.XFBML.parse();

    //$symposium.find(".event-share .twitter-share-button-container").html('<a class="twitter-share-button" href="https://twitter.com/intent/tweet?url=' + permalink + '&text=' + title + '" data-size="large"><img src="https://spokenweb.ca/_/img/tweet.png" height="28"></a>');

    //$symposium.find(".event-share .fb-share-button-container").html('<div class="fb-share-button" data-href="'+permalink+'" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; display:inline; padding-left:5px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+permalink+'" class="fb-xfbml-parse-ignore"><img src="https://spokenweb.ca/_/img/fb-share.png" height="28"></a></div>');


    if (init == 1) {
      $nav = $("#symposiaNav");
      $dropdown = $nav.find(".dropdown-menu");
      $dropdownBtn = $nav.find(".dropdown-toggle");

      $nav.find("a.nav-link.year").each(function(i) {
        var year = $symposia.eq(i).data('startyear');
        var postname = $symposia.eq(i).attr("id");
        $(this).text(year);
        $(this).attr("href", "#/" + postname);
        $(this).attr("data-index", i);
        if (postname!=undefined) $(this).parent().show();
      });

      for (i = 2; i < $symposia.length; i++) {
        $nav.find(".nav-item").eq(i).show();
        var year = $symposia.eq(i).data('startyear');
        var postname = $symposia.eq(i).attr("id");
        $dropdown.append('<a class="dropdown-item year" href="#/' + postname + '" data-index="' + i + '">' + year + '</a>');
      }

      $nav.find("a.nav-link.year, a.dropdown-item.year").click(function(e) {
        e.preventDefault();

        window.location.hash = e.target.hash;

        $nav.find("a.nav-link.active").removeClass("active");
        $nav.find("a.dropdown-item.active").removeClass("active");

        $(this).addClass("active");

        if ($(this).hasClass("dropdown-item")) {
          $dropdownBtn.addClass("active");
        }
        var index = $(this).data('index');
        toggleSymposium(index);
      });

    }
  }

  $(window).on('load', function() {
    toggleSymposium(0, 1);

    $nav = $("#symposiaNav");

    $page = $(window.location.hash.replace("/", ""));
    if ($page.length > 0) {
      var index = $page.data("i");
      $nav.find('a.year').eq(index).trigger('click');
      toggleSymposium(index);
    }

  });

}

if (page == "cfp") {
  if ($(".btn-sw") && $(".btn-sw").length>0){
    $(document).ready(function() {
      $(".cfp .btn-sw.red, .cfp .btn-sw.black").css("width", $(".cfp").width() + "px");
    });
    var sticky = new Waypoint.Sticky({
      element: $('.sticky')[0]
    })
    $(window).on('resize', function() {
      $(".cfp .btn-sw.red").css("width", $(".cfp").width() + "px");
    });
  }
}


if (page == "past-events") {
  $(window).on('load', function() {
    $("body").scrollTo($("#past").position().top, 400, {
      offset: 0,
      axis: 'y'
    });
  });
}

if (page == "episodes") {
  $(".category-select a").click(function(e) {
    e.preventDefault();
    $cat = $(this).attr("href").replace("#", "");
    $(this).parent().parent().find(".category-select a button").removeClass("active");
    $(this).find("button").addClass("active");
    if ($cat == "desc") {
      $(".episodes .desc").fadeIn();
      $(".episodes .asc").hide();
    }
    if ($cat == "asc") {
      $(".episodes .asc").fadeIn();
      $(".episodes .desc").hide();
    }
  });
}


if ($("body").hasClass("single-podcast")) {
  $("#audio-embed-link").click(function(e) {
    e.preventDefault();
    $(".audio-embed").fadeIn();
    $("body").scrollTo(".audio-embed", 500);
    //$(this).parent().hide();
  });

  $(".category-select a").click(function(e) {
    e.preventDefault();
    $cat = $(this).attr("href").replace("#", "");
    $(this).parent().parent().find(".category-select a button").removeClass("active");
    $(this).find("button").addClass("active");
    if ($cat == "summary") {
      $(".episode #summary").fadeIn();
      $(".episode #transcript").hide();
    }
    if ($cat == "transcript") {
      $(".episode #transcript").fadeIn();
      $(".episode #summary").hide();
    }
  });

}

if ($("body").hasClass("home")) {

  initAudioPlayer();

  function initAudioPlayer() {
    status = "paused";
    $(".audio-play span").addClass("oi-media-play");
    $(".audio-play span").removeClass("oi-media-pause");

    wavesurfer = WaveSurfer.create({
      container: '.waveform',
      waveColor: '#f0f0f0',
      progressColor: '#E07D21',
      cursorColor: '#E07D21',
      barWidth: 1,
      normalize: true,
      height: 34,
      responsive: true,
      backend: 'MediaElement'
    });

    $(".audio-play").click(function() {
      wavesurfer.playPause();
    });

    wavesurfer.on('ready', function() {
      $(".waveform audio").remove();
      $duration = parseInt(wavesurfer.getDuration());
      if ($duration / 60 < 60) {
        $(".currentTime").text(moment.duration(wavesurfer.getCurrentTime(), "seconds").format("mm:ss", {
          trim: "false"
        }));
        $(".duration").text(moment.duration(wavesurfer.getDuration(), "seconds").format("mm:ss", {
          trim: "false"
        }));
      } else {
        $(".currentTime").text(moment.duration(wavesurfer.getCurrentTime(), "seconds").format("hh:mm:ss", {
          trim: "false"
        }));
        $(".duration").text(moment.duration(wavesurfer.getDuration(), "seconds").format("hh:mm:ss", {
          trim: "false"
        }));
      }
    });

    wavesurfer.on('audioprocess', function() {
      $duration = parseInt(wavesurfer.getDuration());

      if ($duration / 60 < 60) {
        $(".currentTime").text(moment.duration(wavesurfer.getCurrentTime(), "seconds").format("mm:ss", {
          trim: "false"
        }));
        $(".duration").text(moment.duration(wavesurfer.getDuration(), "seconds").format("mm:ss", {
          trim: "false"
        }));
      } else {
        $(".currentTime").text(moment.duration(wavesurfer.getCurrentTime(), "seconds").format("hh:mm:ss", {
          trim: "false"
        }));
        $(".duration").text(moment.duration(wavesurfer.getDuration(), "seconds").format("hh:mm:ss", {
          trim: "false"
        }));
      }

    });


    wavesurfer.load($("#audio").data("audio"));

    wavesurfer.on('play', function() {
      status = "playing";
      $(".audio-play span").removeClass("oi-media-play");
      $(".audio-play span").addClass("oi-media-pause");
    });

    wavesurfer.on('pause', function() {
      status = "paused";
      $(".audio-play span").addClass("oi-media-play");
      $(".audio-play span").removeClass("oi-media-pause");
    });

  }

  $(".home .blm a[href^='#']").click(function(e){
    e.preventDefault()
    if ($(".blm .post-content").is(":hidden")){
      $(".blm .post-excerpt").hide();
      $(".blm .post-content").show();
    }
    $(window).animate({
      scrollTop: $(e.target.hash).offset().top - 20
    }, 800);
  });

}

if ($("body").hasClass('single-events')) {
  $(window).on('load', function() {
    $post_name = window.location.pathname.split('/').filter(function(el) {
      return !!el;
    }).pop();
    $(window).scrollTo($("#" + $post_name).position().top, 0, {
      axis: 'y'
    });
    $("#" + $post_name).find("a.event-link").trigger("click");

    permalink = $("#" + $post_name).find("a.event-link").data('permalink');

    modal.find('.modal-body .event-share .fb-share-button-container').html('<div class="fb-share-button" data-href="' + permalink + '" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; display:inline; padding-left:5px;"></div>');

    FB.XFBML.parse();

  });
}

if (page == "events" || page == "past-events" || $("body").hasClass('single-events')) {

  $("#upcomingEvent a.read-more").click(function(e) {
    e.preventDefault();
    $post_name = $(this).attr("href").split('/').filter(function(el) {
      return !!el;
    }).pop();
    $(window).scrollTo($("#" + $post_name).position().top, 400, {
      axis: 'y'
    });
    $("#" + $post_name).find("a.event-link").trigger("click");
  });

  $('#eventModal').on('show.bs.modal', function(event) {

    button = $(event.relatedTarget).parent(); // Button that triggered the modal
    type = button.data('type');
    title = button.data('title');
    img = button.data('img');
    content = button.data('content');
    content = content.replace(/\&nbsp;/g, " ")
    start_month = button.data('startmonth');
    start_day = button.data('startday');
    start_year = button.data('startyear');
    end_month = button.data('endmonth');
    end_day = button.data('endday');
    end_year = button.data('endyear');
    event_start = button.data('eventstart');
    event_end = button.data('eventend');
    time = button.data('time');

    event_type = button.data('eventtype');

    conf_participants = button.data('confparticipants');
    conf_schedule = button.data('confschedule');
    conf_travel = button.data('conftravel');
    conf_activity = button.data('confactivity');
    conf_accommodations = button.data('confaccommodations');
    conf_notable_events = button.data('confnotableevents');


    permalink = button.data('permalink');

    post_name = permalink.split('/').filter(function(el) {
      return !!el;
    }).pop();

    window.history.pushState(post_name, title + " - SpokenWeb", permalink);

    cats = button.data('cats');
    tags = button.data('tags');

    event_location = button.data('city');
    event_venue = button.data('venue');
    event_institution = button.data('institution');

    var modal = $(this);
    if (type == "past") {
      modal.addClass("past");
    } else {
      modal.removeClass("past");
    }
    modal.find('.modal-body .event-title').text(title);
    modal.find('.modal-body .event-image').css('background', 'url("' + img + '")');
    modal.find('.modal-body .event-start-year').text(start_year);
    modal.find('.modal-body .event-start-month').text(start_month);
    modal.find('.modal-body .event-start-day').text(start_day);
    modal.find('.modal-body .event-image').parent().attr("href", img);


    if ((end_year != "" && end_month != "" && end_day != "") && (event_start != event_end)) {
      modal.find('.modal-body .event-date-dash').show();
      modal.find('.modal-body .event-end-date').show();
      modal.find('.modal-body .event-end-year').text(end_year);
      modal.find('.modal-body .event-end-month').text(end_month);
      modal.find('.modal-body .event-end-day').text(end_day);
    } else {
      modal.find('.modal-body .event-date-dash').hide();
      modal.find('.modal-body .event-end-date').hide();
    }

    if (time != "") {
      modal.find('.modal-body .event-time').show();
      modal.find('.modal-body .event-time span').text(time);
    } else {
      modal.find('.modal-body .event-time').hide();
    }
    modal.find('.modal-body .event-institution span').html("<i class='fas fa-map-marker-alt'></i> " + event_institution + "<br/>" + event_location);
    //modal.find('.modal-body .event-institution span').html("<i class='fas fa-map-marker-alt'></i> "+event_institution);
    //modal.find('.modal-body .event-location span').text(event_location);

    if (typeof event_venue != "undefined" && event_venue != "") {
      modal.find('.modal-body .event-venue span').text(event_venue);
      modal.find('.modal-body .event-venue').show();
    } else {
      modal.find('.modal-body .event-venue').hide();
    }

    modal.find('.modal-body .event-content').html(content);

    if (event_type == "Conference") {
      modal.find('.modal-body .event-conference').show();
      if (conf_participants != "") {
        modal.find('.modal-body .event-conference .conf-participants').show();
        modal.find('.modal-body .event-conference .conf-participants.text').html(conf_participants);
      } else {
        modal.find('.modal-body .event-conference .conf-participants').hide();
      }
      if (conf_schedule != "") {
        modal.find('.modal-body .event-conference .conf-schedule').show();
        modal.find('.modal-body .event-conference .conf-schedule.text').html(conf_schedule);
      } else {
        modal.find('.modal-body .event-conference .conf-schedule').hide();
      }
      if (conf_travel != "") {
        modal.find('.modal-body .event-conference .conf-participant-info-travel').show();
        modal.find('.modal-body .event-conference .conf-participant-info-travel.text').html(conf_travel);
      } else {
        modal.find('.modal-body .event-conference .conf-participant-info-travel').hide();
      }
      if (conf_activity != "") {
        modal.find('.modal-body .event-conference .conf-participant-info-activity').show();
        modal.find('.modal-body .event-conference .conf-participant-info-activity.text').html(conf_activity);
      } else {
        modal.find('.modal-body .event-conference .conf-participant-info-activity').hide();
      }
      if (conf_accommodations != "") {
        modal.find('.modal-body .event-conference .conf-participant-info-accommodations').show();
        modal.find('.modal-body .event-conference .conf-participant-info-accommodations.text').html(conf_accommodations);
      } else {
        modal.find('.modal-body .event-conference .conf-participant-info-accommodations').hide();
      }
      if (conf_notable_events != "") {
        modal.find('.modal-body .event-conference .conf-notable-events').show();
        modal.find('.modal-body .event-conference .conf-notable-events.text').html(conf_notable_events);
      } else {
        modal.find('.modal-body .event-conference .conf-notable-events').hide();
      }
    } else {
      modal.find('.modal-body .event-conference').hide();
    }

    $cat_links = [];
    $tag_links = [];

    //$.each(cats, function( index, cat ) {
    //$cat_links.push('<a href="https://spokenweb.ca/category/'+cat.slug+'">'+cat.name+'</a>');
    //});

    // clear out the <a> tag that's currently there...probably don't really need this since you're replacing whatever is in there already.

    /*
                  <a class="twitter-share-button" href="https://twitter.com/intent/tweet?url=<?php echo $actual_link;?>" data-size="large">Tweet</a>
                  <div class="fb-share-button" data-href="<?php echo $actual_link;?>" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; top:-8px; margin-bottom:5px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

    */

    modal.find('.modal-body .event-share .twitter-share-button-container').html('<a class="twitter-share-button" href="https://twitter.com/intent/tweet?url=' + permalink + '&text=' + title + '" data-size="large"><img src="https://spokenweb.ca/_/img/tweet.png" height="28"></a>');

    modal.find('.modal-body .event-share .fb-share-button-container').html('<div class="fb-share-button" data-href="' + permalink + '" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; display:inline; padding-left:5px;"></div>');

    FB.XFBML.parse();

    $.each(tags, function(index, tag) {
      $tag_links.push('<a href="https://spokenweb.ca/tag/' + tag.slug + '">' + tag.name + '</a>');
    });

    modal.find('.modal-body .event-footer .cats').html($cat_links.join(', '));
    modal.find('.modal-body .event-footer .tags').html($tag_links.join(', '));

    if ($tag_links.length <= 0) $(".event-footer .tags-container").hide();
    else $(".event-footer .tags-container").show();

  });

  $('#eventModal').on('shown.bs.modal', function(event) {

    button = $(event.relatedTarget).parent(); // Button that triggered the modal
    title = button.data('title');
    img = button.data('img');
    content = button.data('content');
    imgwidth = button.data('imgwidth');
    imgheight = button.data('imgheight');

    var modal = $(this);

    $imgratio = imgwidth / imgheight;

    $imgwidth = modal.find('.modal-body .event-image').width();
    $imgheight = $imgwidth / $imgratio;


    if ($imgheight < $imgwidth) {
      $imgheight = $imgwidth * 2;
    }

    $contentheight = modal.find('.modal-body .content-container').height();

    if ($(window).width() > 576) {

      if ($imgheight > $contentheight) $imgheight = $contentheight;

      modal.find('.modal-body .event-image').css("height", $imgheight);

    }

    modal.find('.modal-body .event-image').fadeIn();
    $('.fancybox').fancybox();

  });

  $(window).on('resize', function() {
    if ($("#eventModal").hasClass('show')) {
      var modal = $("#eventModal");
      $imgwidth = modal.find('.modal-body .event-image').width();
      modal.find('.modal-body .event-image').css("height", $imgwidth);
    }
  });

  $('#eventModal').on('hidden.bs.modal', function(e) {
    var modal = $(this);
    modal.find('.modal-body .event-title').text('');
    modal.find('.modal-body .event-image').css('background', 'none');

    modal.find('.modal-body .event-year').text('');
    modal.find('.modal-body .event-month').text('');
    modal.find('.modal-body .event-day').text('');
    modal.find('.modal-body .event-content').html('');

    $post_name = window.location.pathname.split('/').filter(function(el) {
      return !!el;
    }).pop();
    $path = window.location.pathname.replace("/" + $post_name, "");

    window.history.pushState('events', "Events - SpokenWeb", $path);
    modal.find('.modal-body .event-image').fadeOut();

  })

  $(document).ready(function() {
    $windowheight = $(window).height() - 80;
    $offset = 240;
    if ($(window).width() <= 576) {
      $offset = 240 + 120;
    }
    $height = $("#upcomingEvent .info-container").height() + $offset;
    if ($height > $windowheight) $("#upcomingEvent .event-img").css("height", $height + "px");
    else $("#upcomingEvent .event-img").css("height", $windowheight + "px");
  });

  $(window).on('load', function() {
    $windowheight = $(window).height() - 80;
    $offset = 240;
    if ($(window).width() <= 576) {
      $offset = 240 + 120;
    }
    $height = $("#upcomingEvent .info-container").height() + $offset;
    if ($height > $windowheight) $("#upcomingEvent .event-img").css("height", $height + "px");
    else $("#upcomingEvent .event-img").css("height", $windowheight + "px");
  });

  $(window).on('resize', function() {
    $windowheight = $(window).height() - 80;
    $offset = 240;
    if ($(window).width() <= 576) {
      $offset = 240 + 120;
    }
    $height = $("#upcomingEvent .info-container").height() + $offset;
    if ($height > $windowheight) $("#upcomingEvent .event-img").css("height", $height + "px");
    else $("#upcomingEvent .event-img").css("height", $windowheight + "px");
  });

  $(".category-select a").click(function(e) {
    e.preventDefault();
    $cat = $(this).attr("href").replace("#", "");
    $(this).parent().parent().find(".category-select a button").removeClass("active");
    $(this).find("button").addClass("active");
    if ($cat == "all") {
      $(this).parent().parent().find(".event").removeClass("mask");
    } else {
      $(this).parent().parent().find(".event").addClass("mask");
      $(this).parent().parent().find(".cat_" + $cat).removeClass("mask");
    }
  });

  $("#selectInstitution").change(function() {
    $curInstitution = $(this).val();
    if ($curInstitution == "All") {
      $("#past .event").each(function() {
        $(this).show();
      });
    } else {
      $("#past .event").each(function() {
        if ($(this).data("institution") == $curInstitution) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
    $("#selectLocation").val("All");
    $("#selectYear").val("All");
  });

  $("#selectYear").change(function() {
    $curYear = $(this).val();
    if ($curYear == "All") {
      $("#past .event").each(function() {
        $(this).show();
      });
    } else {
      $("#past .event").each(function() {
        if ($(this).data("year") == $curYear) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
    $("#selectInstitution").val("All");
    $("#selectLocation").val("All");
  });

  $("#selectLocation").change(function() {
    $curLocation = $(this).val();
    if ($curLocation == "All") {
      $("#past .event").each(function() {
        $(this).show();
      });
    } else {
      $("#past .event").each(function() {
        if ($(this).data("location") == $curLocation) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
    $("#selectInstitution").val("All");
    $("#selectYear").val("All");
  });


  function eventsSidebar() {

    var locations = [];
    var years = [];
    var institutions = [];

    $("#past .event:visible").each(function() {
      locations.push($(this).data("location"));
      years.push($(this).data("year"));
      institutions.push($(this).data("institution"));
    });

    locations = locations.filter(function(e) {
      return e
    });
    years = years.filter(function(e) {
      return e
    });
    institutions = institutions.filter(function(e) {
      return e
    });

    locations = unique(locations);
    years = unique(years);
    institutions = unique(institutions);

    locations.sort();
    years.sort();
    years.reverse();
    institutions.sort();


    $("#selectInstitution option").remove();
    $("#selectInstitution").append('<option value="All">All</option>');
    for (var i = 0; i < institutions.length; i++) {
      $("#selectInstitution").append('<option value="' + institutions[i] + '">' + institutions[i] + '</option>');
    }

    $("#selectYear option").remove();
    $("#selectYear").append('<option value="All">All</option>');
    for (var i = 0; i < years.length; i++) {
      $("#selectYear").append('<option value="' + years[i] + '">' + years[i] + '</option>');
    }

    $("#selectLocation option").remove();
    $("#selectLocation").append('<option value="All">All</option>');
    for (var i = 0; i < locations.length; i++) {
      $("#selectLocation").append('<option value="' + locations[i] + '">' + locations[i] + '</option>');
    }

  }

  $(window).on('load', function() {
    eventsSidebar();
  });

}


if (page == "collections") {

  $("#selectInstitution").change(function() {
    $new_i = 0;
    $(".people-container").removeClass("first");
    $curInstitution = $(this).val();
    $(".people-container").removeAttr("data-i");
    $(".people-container .current a").first().trigger("click");
    if ($curInstitution == "All") {
      $(".people-container").each(function() {
        $(this).show();
        $(this).attr("data-i", $new_i);
        $(this).data('i', $new_i);
        if ($new_i % 4 === 0) $(this).addClass("first");
        $new_i++;
      });
    } else {
      $(".people-container").each(function() {
        if ($(this).data("institution") == $curInstitution) {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data("i", $new_i);
          if ($new_i % 4 === 0) $(this).addClass("first");
          $new_i++;
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".people-container").length;
      $prev_height = 0;
      $first_i = 0;
    }
    $("#selectFunction").val("All");
    $("#selectAffiliation").val("All");
    //teamSidebar("institution");
  });

  $("#selectFunction").change(function() {
    $new_i = 0;
    $(".people-container").removeClass("first");
    $curFunction = $(this).val();
    $(".people-container").removeAttr("data-i");
    $(".people-container .current a").first().trigger("click");
    if ($curFunction == "All") {
      $(".people-container").each(function() {
        $(this).show();
        $(this).attr("data-i", $new_i);
        $(this).data('i', $new_i);
        if ($new_i % 4 === 0) $(this).addClass("first");
        $new_i++;
      });
    } else {
      $(".people-container").each(function() {
        if ($(this).data("function").indexOf($curFunction) > -1) {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data("i", $new_i);
          if ($new_i % 4 === 0) $(this).addClass("first");
          $new_i++;
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".people-container").length;
      $prev_height = 0;
      $first_i = 0;
    }


    $("#selectAffiliation").val("All");
    $("#selectInstitution").val("All");
    //teamSidebar("function");
  });

  if (typeof location.hash != 'undefined') {
    $("window").position(0);
    $this = $(".people-container a[href='" + location.hash + "']");
    $target = $(location.hash);
    if ($target.length) {
      //$("body").scrollTo($this, 400, {offset:-10, onAfter: function(){
      $target.slideDown();
      //}});
    }
  }

  function teamSidebar(changed) {
    var institutions = [];

    //$(".people-container:visible").each(function(){
    $(".people-container:visible").each(function() {
      institutions.push($(this).data("institution"));
    });

    institutions = institutions.filter(function(e) {
      return e
    });

    institutions = unique(institutions);

    institutions.sort();

    //if (changed!="institution"){
    $("#selectInstitution option").remove();
    $("#selectInstitution").append('<option value="All">All</option>');
    for (var i = 0; i < institutions.length; i++) {
      $("#selectInstitution").append('<option value="' + institutions[i] + '">' + institutions[i] + '</option>');
    }
    //}

  }


  $(window).on('load', function() {
    teamSidebar();
  });

  $prev_i = $(".people-container").length;
  $prev_height = 0;
  $first_i = 0;
  $(".people-container a").click(function(e) {
    if (!$this.hasClass("external")) {
      $this = $(this);
      $(".people-container").css("top", "0px");
      $("#teamContainer").css("margin-bottom", "0px");
      e.preventDefault();
      $target = $("#bioContainer");

      $currentTop = $(this).parent().parent().offset().top - $("#teamContainer").offset().top;
      $currentBottom = $currentTop + $(this).parent().parent().height();

      if ($(this).parent().hasClass("current")) {
        $target.hide();
        $(this).parent().removeClass("current");
      } else {
        //$(".people-container .current a").trigger('click');

        $(".people-container .current").removeClass("current");
        $(this).parent().addClass("current");

        $bioContent = $(this).parent().find(".bio-content");
        if ($target.is(":hidden")) {
          $cur_i = $this.parent().parent().data('i');

          $target.css("top", $currentBottom + "px");
          $target.html($bioContent.html());

          $target.show();

          $cur_height = $target.height() + 60;
          $("#teamContainer").css("margin-bottom", $cur_height + "px");

          if ($this.parent().parent().hasClass(".first")) {
            $this.parent().parent().css("top", $cur_height + "px").nextAll(".people-container").css("top", $cur_height + "px");
          } else {
            $this.parent().parent().nextAll(".first").eq(0).css("top", $cur_height + "px").nextAll(".people-container").css("top", $cur_height + "px");
          }

          $(window).scrollTo($this.parent().parent(), "400", {
            offset: -20
          });

        } else {
          $target.hide();

          $cur_i = $this.parent().parent().data('i');

          if ($this.parent().parent().hasClass("first")) {
            if ($cur_i > $prev_i) {
              $target.css("top", $currentBottom - $prev_height + "px");
            } else {
              $target.css("top", $currentBottom + "px");
            }
          } else {
            $first_i = $(".people-container[data-i=" + $prev_i + "]").nextAll(".first").eq(0).data("i");

            if ($cur_i > $prev_i && $cur_i > $first_i) {
              $target.css("top", $currentBottom - $prev_height + "px");
              $(window).scrollTo($this.parent().parent(), "400", {
                offset: -(20 + $prev_height)
              });
            } else {
              $target.css("top", $currentBottom + "px");
            }
          }

          $target.html($bioContent.html());
          $target.show();

          $cur_height = $target.height() + 60;
          $("#teamContainer").css("margin-bottom", $cur_height + "px");

          if ($this.parent().parent().hasClass(".first")) {
            // $this.parent().parent().css("top", $cur_height+"px").nextAll(".people-container").css("top", $cur_height+"px");
          } else {
            $this.parent().parent().nextAll(".first").eq(0).css("top", $cur_height + "px").nextAll(".people-container").css("top", $cur_height + "px");
          }

        }

        $prev_i = $cur_i;
        $prev_height = $cur_height;


      }
    }
  });

  $(window).on('resize', function() {
    $(".people-container .current a").first().trigger("click");
  });

  $("button.close").click(function() {
    $(this).parent().parent().slideUp();
  });

}

if (page == "publications") {
  $("#selectYear").change(function() {
    $new_i = 0;
    $curYear = $(this).val();
    $(".publication-content").removeAttr("data-i");
    if ($curYear == "All") {
      $(".publication-container").show();
      $(".publication-content").each(function() {
        $(this).show();
        $(this).attr("data-i", $new_i);
        $(this).data('i', $new_i);
        $new_i++;
      });
    } else {
      $(".publication-container").hide();
      $(".publication-content").each(function() {
        if ($(this).data("year") == $curYear) {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data("i", $new_i);
          $new_i++;
          $(this).parent().show();
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".publication-content").length;
      $first_i = 0;
    }
    $("#selectType").val("All");
    $("#selectTeamMember").val("All");
    // $("#selectYear").val("All");
  });

  $("#selectTeamMember").change(function() {
    $new_i = 0;
    $curTeamMember = $(this).val();
    $(".publication-content").removeAttr("data-i");
    if ($curTeamMember == "All") {
      $(".publication-container").show();
      $(".publication-content").each(function() {
        $(this).show();
        $(this).attr("data-i", $new_i);
        $(this).data('i', $new_i);
        $new_i++;
      });
    } else {
      $(".publication-container").hide();
      $(".publication-content").each(function() {
        if ($(this).data("team-members").indexOf($curTeamMember)>-1) {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data("i", $new_i);
          $new_i++;
          $(this).parent().show();
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".publication-content").length;
      $first_i = 0;
    }
    $("#selectType").val("All");
    // $("#selectTeamMember").val("All");
    $("#selectYear").val("All");
  });

  $("#selectType").change(function() {
    $new_i = 0;
    $curType = $(this).val();
    $(".publication-content").removeAttr("data-i");
    if ($curType == "All") {
      $(".publication-container").show();
      $(".publication-content").each(function() {
        $(this).show();
        $(this).attr("data-i", $new_i);
        $(this).data('i', $new_i);
        $new_i++;
      });
    } else {
      $(".publication-container").hide();
      $(".publication-content").each(function() {
        if ($(this).data("type") == $curType) {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data("i", $new_i);
          $new_i++;
          $(this).parent().show();
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".publication-content").length;
      $first_i = 0;
    }
    // $("#selectType").val("All");
    $("#selectTeamMember").val("All");
    $("#selectYear").val("All");
  });

  function teamSidebar(changed) {
    var years = [];
    var teamMembers = [];
    var types = [];

    //$(".people-container:visible").each(function(){
    $(".publication-content:visible").each(function() {
      years.push($(this).data("year"));
      types.push($(this).data("type"));

      teamMembersArray = $(this).data("team-members").split(",");
      for (const teamMember of teamMembersArray) {
        teamMembers.push(teamMember);
      }

    });

    years = years.filter(function(e) {
      return e
    });
    teamMembers = teamMembers.filter(function(e) {
      return e
    });
    types = types.filter(function(e) {
      return e
    });

    years = unique(years);

    teamMembers = unique(teamMembers);
    types = unique(types);

    years.sort(function(a, b){return b-a});
    teamMembers.sort();
    types.sort();


    $("#selectYear option").remove();
    $("#selectYear").append('<option value="All">All</option>');
    for (var i = 0; i < years.length; i++) {
      $("#selectYear").append('<option value="' + years[i] + '">' + years[i] + '</option>');
    }

    $("#selectType option").remove();
    $("#selectType").append('<option value="All">All</option>');
    for (var i = 0; i < types.length; i++) {
      $("#selectType").append('<option value="' + types[i] + '">' + types[i] + '</option>');
    }

    $("#selectTeamMember option").remove();
    $("#selectTeamMember").append('<option value="All">All</option>');
    for (var i = 0; i < teamMembers.length; i++) {
      $("#selectTeamMember").append('<option value="' + teamMembers[i] + '">' + teamMembers[i] + '</option>');
    }

  }


  $(window).on('load', function() {
    teamSidebar();
  });

}


if (page == "team") {

  $("#selectAffiliation").change(function() {
    $new_i = 0;
    $(".people-container").removeClass("first");
    $curAffiliation = $(this).val();
    $(".people-container").removeAttr("data-i");
    $(".people-container .current a").first().trigger("click");
    if ($curAffiliation == "All") {
      $(".people-container").each(function() {
        if ($(this).data("status") == "Past Member") {
          $(this).hide();
        } else {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data('i', $new_i);
          if ($new_i % 4 === 0) $(this).addClass("first");
          $new_i++;
        }
      });
    } else if ($curAffiliation == "Past Members") {
      $(".people-container").each(function() {
        if ($(this).data("status") == "Past Member") {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data("i", $new_i);
          if ($new_i % 4 === 0) $(this).addClass("first");
          $new_i++;
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".people-container").length;
      $prev_height = 0;
      $first_i = 0;
    } else {
      $(".people-container").each(function() {
        if ($(this).data("affiliation") == $curAffiliation) {
          if ($(this).data("status") == "Past Member") {
            $(this).hide();
          } else {
            $(this).show();
            $(this).attr("data-i", $new_i);
            $(this).data("i", $new_i);
            if ($new_i % 4 === 0) $(this).addClass("first");
            $new_i++;
          }
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".people-container").length;
      $prev_height = 0;
      $first_i = 0;
    }
    $("#selectFunction").val("All");
    $("#selectInstitution").val("All");

    //teamSidebar("affiliation");
  });

  $("#selectInstitution").change(function() {
    $new_i = 0;
    $(".people-container").removeClass("first");
    $curInstitution = $(this).val();
    $(".people-container").removeAttr("data-i");
    $(".people-container .current a").first().trigger("click");
    if ($curInstitution == "All") {
      $(".people-container").each(function() {
        if ($(this).data("status") == "Past Member") {
          $(this).hide();
        } else {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data('i', $new_i);
          if ($new_i % 4 === 0) $(this).addClass("first");
          $new_i++;
        }
      });
    } else {
      $(".people-container").each(function() {
        if ($(this).data("institution") == $curInstitution) {
          if ($(this).data("status") == "Past Member") {
            $(this).hide();
          } else {
            $(this).show();
            $(this).attr("data-i", $new_i);
            $(this).data("i", $new_i);
            if ($new_i % 4 === 0) $(this).addClass("first");
            $new_i++;
          }
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".people-container").length;
      $prev_height = 0;
      $first_i = 0;
    }
    $("#selectFunction").val("All");
    $("#selectAffiliation").val("All");
    //teamSidebar("institution");
  });

  $("#selectFunction").change(function() {
    $new_i = 0;
    $(".people-container").removeClass("first");
    $curFunction = $(this).val();
    $(".people-container").removeAttr("data-i");
    $(".people-container .current a").first().trigger("click");
    if ($curFunction == "All") {
      $(".people-container").each(function() {
        if ($(this).data("status") == "Past Member") {
          $(this).hide();
        } else {
          $(this).show();
          $(this).attr("data-i", $new_i);
          $(this).data('i', $new_i);
          if ($new_i % 4 === 0) $(this).addClass("first");
          $new_i++;
        }
      });
    } else {
      $(".people-container").each(function() {
        if ($(this).data("function").indexOf($curFunction) > -1) {
          if ($(this).data("status") == "Past Member") {
            $(this).hide();
          } else {
            $(this).show();
            $(this).attr("data-i", $new_i);
            $(this).data("i", $new_i);
            if ($new_i % 4 === 0) $(this).addClass("first");
            $new_i++;
          }
        } else {
          $(this).hide();
        }
      });
      $cur_i = 0;
      $prev_i = $(".people-container").length;
      $prev_height = 0;
      $first_i = 0;
    }


    $("#selectAffiliation").val("All");
    $("#selectInstitution").val("All");
    //teamSidebar("function");
  });

  if (typeof location.hash != 'undefined') {
    $("window").position(0);
    $this = $(".people-container a[href='" + location.hash + "']");
    $target = $(location.hash);
    if ($target.length) {
      //$("body").scrollTo($this, 400, {offset:-10, onAfter: function(){
      $target.slideDown();
      //}});
    }
  }

  function teamSidebar(changed) {
    var affiliations = [];
    var functions = [];
    var institutions = [];

    //$(".people-container:visible").each(function(){
    $(".people-container:visible").each(function() {
      affiliations.push($(this).data("affiliation"));
      functions.push($(this).data("function"));
      institutions.push($(this).data("institution"));
    });

    affiliations = affiliations.filter(function(e) {
      return e
    });
    functions = functions.filter(function(e) {
      return e
    });
    institutions = institutions.filter(function(e) {
      return e
    });

    affiliations = unique(affiliations);
    functions = unique(functions);
    institutions = unique(institutions);

    affiliations.sort();
    functions.sort();
    institutions.sort();


    $("#selectInstitution option").remove();
    $("#selectInstitution").append('<option value="All">All</option>');
    for (var i = 0; i < institutions.length; i++) {
      $("#selectInstitution").append('<option value="' + institutions[i] + '">' + institutions[i] + '</option>');
    }

  }

  $(window).on('load', function() {
    teamSidebar();
  });

  $prev_i = $(".people-container").length;
  $prev_height = 0;
  $first_i = 0;
  $(".people-container a").click(function(e) {
    if (!$this.hasClass("external")) {
      $this = $(this);
      $(".people-container").css("top", "0px");
      $("#teamContainer").css("margin-bottom", "0px");
      e.preventDefault();
      $target = $("#bioContainer");

      $currentTop = $(this).parent().parent().offset().top - $("#teamContainer").offset().top;
      $currentBottom = $currentTop + $(this).parent().parent().height();

      if ($(this).parent().hasClass("current")) {
        $target.hide();
        $(this).parent().removeClass("current");
      } else {
        //$(".people-container .current a").trigger('click');

        $(".people-container .current").removeClass("current");
        $(this).parent().addClass("current");

        $bioContent = $(this).parent().find(".bio-content");
        if ($target.is(":hidden")) {
          $cur_i = $this.parent().parent().data('i');

          $target.css("top", $currentBottom + "px");
          $target.html($bioContent.html());

          $target.show();

          $cur_height = $target.height() + 60;
          $("#teamContainer").css("margin-bottom", $cur_height + "px");

          if ($this.parent().parent().hasClass(".first")) {
            $this.parent().parent().css("top", $cur_height + "px").nextAll(".people-container").css("top", $cur_height + "px");
          } else {
            $this.parent().parent().nextAll(".first").eq(0).css("top", $cur_height + "px").nextAll(".people-container").css("top", $cur_height + "px");
          }

          $(window).scrollTo($this.parent().parent(), "400", {
            offset: -20
          });

        } else {
          $target.hide();

          $cur_i = $this.parent().parent().data('i');

          if ($this.parent().parent().hasClass("first")) {
            if ($cur_i > $prev_i) {
              $target.css("top", $currentBottom - $prev_height + "px");
            } else {
              $target.css("top", $currentBottom + "px");
            }
          } else {
            $first_i = $(".people-container[data-i=" + $prev_i + "]").nextAll(".first").eq(0).data("i");

            if ($cur_i > $prev_i && $cur_i > $first_i) {
              $target.css("top", $currentBottom - $prev_height + "px");
              $(window).scrollTo($this.parent().parent(), "400", {
                offset: -(20 + $prev_height)
              });
            } else {
              $target.css("top", $currentBottom + "px");
            }
          }

          $target.html($bioContent.html());
          $target.show();

          $cur_height = $target.height() + 60;
          $("#teamContainer").css("margin-bottom", $cur_height + "px");

          if ($this.parent().parent().hasClass(".first")) {
            // $this.parent().parent().css("top", $cur_height+"px").nextAll(".people-container").css("top", $cur_height+"px");
          } else {
            $this.parent().parent().nextAll(".first").eq(0).css("top", $cur_height + "px").nextAll(".people-container").css("top", $cur_height + "px");
          }

        }

        $prev_i = $cur_i;
        $prev_height = $cur_height;


      }
    }
  });

  $(window).on('resize', function() {
    $(".people-container .current a").first().trigger("click");
  });

  $("button.close").click(function() {
    $(this).parent().parent().slideUp();
  });

}
