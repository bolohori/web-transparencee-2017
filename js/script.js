jQuery(document).ready(function($) {
  if($("#InteractiveMap").length > 0){
		
		if (country !== 'all') {
			$('.cs-fs').html($('.country-select a[data-country-slug="' + country + '"]').data('country')).addClass('selected');
			$('#InteractiveMap .country[data-country="' + $('.country-select a[data-country-slug="' + country + '"]').data('country') + '"]').addClass('active');
		}
		if (topic !== 'all') {
			$('.top-fs').html($('.topic-select a[data-topic-slug="' + topic + '"]').html()).addClass('selected');
		}
		
		
    // Country hover function
    $("#InteractiveMap .country").mouseenter(function(){
      var countryName = $(this).attr("data-country");
      //console.log(countryName);
      $(".country-name").show();
      $(".country-name").text(countryName);
    });

    $("#InteractiveMap .country").mouseleave(function(){
      $(".country-name").hide();
    });
    // Add .county-name
    $("body").append("<div class='country-name'></div>");

    $(document).on( "mousemove", function(event) {
      newX = event.pageX;
      newY = event.pageY;
      $(".country-name").css({left: newX + 10, top: newY - 30});
    });
		
		$('.home #InteractiveMap .country').on('click', function() {
			window.location.href = home_url + '/community/country/' + encodeURI($(this).data('country')) + '/topic/all/type/all';
		});
		
		$('#InteractiveMap .country').on('click', function() {
			$('#InteractiveMap .country').removeClass('active');
			$(this).addClass('active');
			$('.country-select a[data-country="' + $(this).data('country') + '"]').click();
			window.history.pushState('', 'Transparencee', home_url + '/community/country/' + country + '/topic/' + topic + '/type/' + type + '/');
		});
  }
  

  // Search icon click 
  $(document).on("click", "li.search a", function(e){
    e.preventDefault();
    $(".search-input").addClass("visible");
    $(".search-input input").focus();
  });

  // Close search input
  $(document).on("click", function(e){
    var clickTarget = $(e.target);
    if(!clickTarget.closest(".search-input").length>0 && !clickTarget.closest("li.search").length>0 ){
      $(".search-input").removeClass("visible");
    }
  });



// Open/close menu
$(document).on("click", ".menu-open", function(e){
  e.preventDefault();
  if($("body.menu-opened").length>0){
    hideMenu();
  }
  else{
    showMenu(); 
  }
});


var showMenu = function(){
  $("body").addClass("menu-opened");
}

var hideMenu = function(){
  $("body").removeClass("menu-opened");
}


// dropdown

$(document).on("click", ".dropdown-menu a", function(e){
  e.preventDefault();
  thisClicked = $(e.target).closest("a").text();
  thisSelect = $(e.target).closest(".dropdown");
  $(thisSelect).find(".filter-select").addClass("selected").text(thisClicked);
});

$('.show-all').on('click', function(e) {
	e.preventDefault();
	var btn = $(this).parents('.button-center');
	btn.html('<img src="' + src + '/img/loading.gif" alt="Loading" />');
	$.ajax({type: 'post', url: src + '/show-all.php',
		data: {

		},
		success: function (data) {
			btn.hide();
			$('.community-results .all-container').html(data);
		}});
	
	return false;
});

$('.topic-select a, .country-select a').on('click', function(e) {
	if ($(this).parents('.dropdown-menu').hasClass('country-select')) {
		country = $(this).data('country-slug');
		$('#InteractiveMap .country').removeClass('active');
		$('#InteractiveMap .country[data-country="' + $(this).data('country') + '"]').addClass('active');
	}
	else if ($(this).parents('.dropdown-menu').hasClass('topic-select')) {
		topic = $(this).data('topic-slug');
	}
	$('.org-list').html('<img src="' + src + '/img/loading.gif" alt="Loading" />');
	$.ajax({type: 'post', url: src + '/show-filtered.php',
		data: {
			'country': country,
			'topic': topic,
			'type': type
		},
		success: function (data) {
			$('.community-results .all-container').html(' ');
			$('.org-list').html(data);
			
			window.history.pushState('', 'Transparencee', home_url + '/community/country/' + country + '/topic/' + topic + '/type/' + type + '/');
		}});
});

$('.type-select a').on('click', function(e) {
	e.preventDefault();
	$('.type-select a').removeClass('active');
	$(this).addClass('active');
	type = $(this).data('type');
	$('.org-list').html('<img src="' + src + '/img/loading.gif" alt="Loading" />');
	$.ajax({type: 'post', url: src + '/show-filtered.php',
		data: {
			'country': country,
			'topic': topic,
			'type': type
		},
		success: function (data) {
			$('.org-list').html(data);
			window.history.pushState('', 'Transparencee', home_url + '/community/country/' + country + '/topic/' + topic + '/type/' + type + '/');
		}});
	
	return false;
});


});