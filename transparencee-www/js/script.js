jQuery(document).ready(function($) {


  if($("#InteractiveMap").length > 0){
    // Country hover function
    $("#InteractiveMap .country").mouseenter(function(){
      var countryName = $(this).attr("data-country");
      console.log(countryName);
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
  }
  

  // Search icon click 
  $(document).on("click", ".search a", function(e){
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


});