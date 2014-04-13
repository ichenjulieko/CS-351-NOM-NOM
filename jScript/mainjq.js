//moving mario
$(document).ready(function() {
	$('button').click(function(){
		$('#panda').html('<img src="http://playrific.com/images/media/kungfu_panda_2_clip_dumplings.png">');
	});
	$('.pull-me').click(function(){
		$('.content').slideToggle('slow')
	});
	$('.weekly').cycle({ 
    fx:     'fade', 
    speed:   300, 
    timeout: 3000, 
    next:   '.weekly', 
    pause:   1 
	});
});
// window.onload = function(){
// 	function keepHeight(id,height){
// 		var divheight = document.getElementById(id);
// 		keepHeight.style.height = (window.innerWidth/(height))+"px";
// 	}
// 	keepHeight("weekly", 10);
// 	window.onresize = function(event){
// 		keepHeight("weekly", 10);
// 	}
// }
// $('#food1').click(function(){
//         $(this).effect('slide');
//         });
//     $('#food2').click(function(){
// 		$(this).effect('bounce', {times:3}, 500);
// 	});
	
// 	$('#food5').click(function(){
// 		$(this).hide();
// 	});
	
// 	$('#food3').draggable();
// 	$('#food4').click(function(){
// 		$(this).effect('explode');