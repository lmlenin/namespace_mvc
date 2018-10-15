$(document).ready(function(){
	
	$(".sidebar").hover(function(){
        $(this).css("margin-left", "0px");
        $("#control_menu").css("visibility", "visible");// visibility
        $("#control_menu").css("opacity", "1");
    });

	$("#control_menu").click(function(e){
		e.preventDefault();
		$(this).css("visibility", "hidden");
		$(this).css("opacity", "0");
		$(".sidebar").css("margin-left", "-160px");
	});

	// control del click en los elementos
	$(".m-li").click(function(e){
		e.preventDefault();
		$(".m-li").removeClass("active");
		$(this).addClass("active");
	});

});
