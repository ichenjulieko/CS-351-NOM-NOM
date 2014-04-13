/*
	Eric Dong
	CS 351 Team Project
	Partner: Julie(Ichen) Ko
*/

//	Constants
var fadeTime = 500;
var names = new Array("one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve");

// Instantiate all pictures and their points
var imgList = new Array();

// Initialize all pictures and their points
function readImages(imgInfo) {
	var image = new Image();
	image.src = imgInfo[2];

	imgList[imgList.length] = image;
}

//	Initializer
function init() {
	var height = 200, width = 200;

	//	Set the source, dimensions, and container div that allows the image to 100% opaque when hovered over
	for(var i = 0; i < 12; i++) {
		var img = document.getElementById(names[i]);
		img.src = imgList[i].src;
		var dim = calcIdealSize(img, width, height);
		img.width = dim[0];
		img.height = dim[1];
		var parent = img.parentNode;
		parent.setAttribute("style", "width: " + dim[0] + "px; height: " + dim[1] + "px; margin-left: auto; margin-right: auto;");
	}

	//	Listener for uploading images
	document.getElementById('uploadForm').onsubmit=function() {
		document.getElementById('uploadForm').target = 'uploadTarget';
		document.getElementById("uploadTarget").onload = receiveUploadResults;
	}
}

//	Deals with the response of an upload attempt
function receiveUploadResults() {
	//	Get the JSON
	var ret = frames['uploadTarget'].document.getElementsByTagName("body")[0].innerHTML;

	//	Parse the JSON
	var data = JSON.parse(ret);

	if(data.success) {
		//	Add image to imgList array
		var image = new Image();
		image.src = data.src;
		imgList[imgList.length] = image;

		alert("Your picture has been uploaded successfully!");
	}
	else
		alert("Upload Error: " + data.message);

	window.location.href = "../html/Vote.php";
}

//	Calculate the ideal size of an image while maintaining aspect ratio given upper bounds
function calcIdealSize(image, upperWidth, upperHeight) {
	var dim = new Array();
	var ratio = image.height/image.width;

	for(var i = upperWidth; i > 0; i--) {
		var h = i*ratio;
		if(h <= upperHeight) {
			dim[0] = i;
			dim[1] = h;
			break;
		}
	}
	return dim;
}

//	Brings in 12 new images
function switchImages() {
	var last = document.getElementById("twelve");
	var startingPoint = 0;

	//	Find the point in the imgList at which the new images will come
	for(var i = 0; i < imgList.length; i++) {
		if(last.src == imgList[i].src) {
			startingPoint = i+1;

			if(startingPoint == imgList.length)
				startingPoint = 0;

			break;
		}
	}

	// alert(startingPoint);
	
	//	Loop through each of the 12 image cells
	for(var i = 0; i < 12; i++) {
		img = document.getElementById(names[i]);
		//	Remove the width and height attributes to reset to default dimensions
		$(img).removeAttr("width");
		$(img).removeAttr("height");
		img.src = imgList[startingPoint++].src;

		//	Calculate ideal size for new image
		dim = calcIdealSize(img, 200, 200);
		img.width = dim[0];
		img.height = dim[1];

		if(startingPoint == imgList.length)
			startingPoint = 0;
	}

	$('.image').fadeIn(fadeTime);
}

//	Banishes the popup
function dismissPopup() {
	var currImg = document.getElementById("popup");
	var currID;

	//	Used to find another image not in the current display
	var imgSrcs = Array();

	//	Find position of image in the set of 12
	for(var i = 0; i < names.length; i++) {
		var check = document.getElementById(names[i]);
		imgSrcs[i] = check.src;
		if(currImg.src == check.src) {
			currID = names[i];
		}
	}

	//	Fade the dark shadow
	$('#shade').fadeOut(fadeTime, function() {
		//	When it's done explode the thumbnail
		$thumb = $('#' + currID);
		$thumb.effect("explode", {pieces: 16}, fadeTime, function() {
			//	Find new image to replace it with
			var newSrc = "";
			for(var i = 0; i < imgList.length; i++) {
				var img = imgList[i];

				var isThere = false;
				//	Check if already on screen
				for(var j = 0; j < names.length; j++) {
					if(img.src == document.getElementById(names[j]).src)
						isThere = true;
				}

				if(isThere == false)
					newSrc = img.src;
			}

			//	Remove attributes to reset size
			$('#' + currID).removeAttr("width");
			$('#' + currID).removeAttr("height");

			var newImg = document.getElementById(currID);
			newImg.src = newSrc;

			//	Calculate ideal size for new image
			var dim = calcIdealSize(newImg, 200, 200);
			newImg.width = dim[0];
			newImg.height = dim[1];

			//	Fade it back in
			$('#' + currID).fadeIn(fadeTime);
		});
	});

	//	Fade out the buttons
	$('.vote').fadeOut(fadeTime);
	//	Fade out vote count label
	$('#voteCount').fadeOut(fadeTime);

	//	Slide the popup off screen to the left
	$('#popup').animate({
		"left": "-100%"
	}, fadeTime, function() {
		//	Reset positions and sizes
		document.getElementById("popup").setAttribute("style", "width: 0; height: 0; left: 50%");

		document.body.className = "";
	});
}

//	Blows up the image on screen
function blowUp(img) {
	var pop = document.getElementById("popup");
	var source = new Image();
	source.src = document.getElementById(img).src;
	pop.src = source.src;

	getImageCount();

	//	Find dimensions of window
	var windowWidth = $(window).width();
	var windowHeight = $(window).height();

	var dim = calcIdealSize(document.getElementById(img), windowWidth, windowHeight*0.9);
	var imgWidth = dim[0];
	var imgHeight = dim[1];

	//	Present pop up and turn off scrolling
	$('#shade').fadeIn(fadeTime, function() {
		//	Display the vote buttons
		$('.vote').fadeIn(fadeTime);
	});
	$('#popup').animate({
			"width": imgWidth,
			"height": imgHeight,
			"left": (windowWidth - imgWidth) / 2,
			"top": 0
	}, fadeTime, function() {
		//	Display the pic's vote count
		var popWidth = document.getElementById("popup").clientWidth;
		var windowWidth = $(window).width();

		var marginRight = (windowWidth - popWidth)/2;

		//	Place on top right corner of image
		$('#voteCount').css({"right": marginRight + "px", "top": 0 + "px"});

		//	Fade it in
		$('#voteCount').fadeIn(fadeTime);
	});
	$('body').addClass('stop-scroll');
}

//	jQuery
$(document).ready(function() {
	$image = $('.image');
	$space = $('.space');
	$pop = $('#popup');
	$next = $('#next');
	$upload = $('#upload');
	$cancel = $('#cancel');

	//	Darken/lighten image on mouseover and mouse leave
	$image.mouseenter(function() {
		var imgID = $(this).attr('id');
		var img = document.getElementById(imgID);
		img.setAttribute("style", "opacity: 1;");
	});
	$image.mouseleave(function() {
		var imgID = $(this).attr('id');
		document.getElementById(imgID).setAttribute("style", "opacity: 0.6");
	});

	//	Blow up image if clicked
	$image.click(function() {
		blowUp($(this).attr('id'));
	});

	//	Open upload form if clicked
	$upload.click(function() {
		//	Reveal form
		$('#uploadDiv').fadeIn(1, function() {
			$('#uploadDiv').animate({
				"height": 75
			}, fadeTime);
		});

		//	Fade in shadow
		$('#shade').fadeIn(fadeTime);

		//	Disable scrolling
		$('body').addClass('stop-scroll');
	});

	//	Close upload form if clicked
	$cancel.click(function() {
		//	Reveal form
		$('#uploadDiv').animate({
			"height": 0
		}, fadeTime, function() {
			$('#uploadDiv').css("display", "none");	
		});

		//	Fade out shadow
		$('#shade').fadeOut(fadeTime);

		//	Enable scrolling
		document.body.className = "";
	});

	//	Remove the blown up image
	$pop.click(function() {
		$('#shade').fadeOut(fadeTime);
		$('.vote').fadeOut(fadeTime);
		$('#voteCount').fadeOut(fadeTime)
		$('#popup').animate({
			"width": 0,
			"height": 0,
			"left": $(window).width() / 2,
			"top": $(window).height() / 2
		}, fadeTime);
		document.body.className = "";
	});

	//	Darken next arrow on mouse over
	$next.mouseenter(function() {
		document.getElementById("next").setAttribute("style", "opacity: 1");
	});
	//	Lighten next arrow on mouse leave
	$next.mouseleave(function() {
		document.getElementById("next").setAttribute("style", "opacity: 0.5");
	});

	//	Replace all twelve images with twelve new ones
	$next.click(function() {
		$image.fadeOut(fadeTime);
		sleep(fadeTime, function() { switchImages(); });
	});
});

function sleep(millis, callback) {
    setTimeout(function()
            { callback(); }
    , millis);
}