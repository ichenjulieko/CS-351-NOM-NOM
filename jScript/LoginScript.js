function validateform() {
	var user = document.getElementById('username').value;
	var password = document.getElementById('pass').value;
	var emailadd = document.getElementById('email').value;

	var namecont = /^[a-zA-Z0-9_-]{6,15}$/;
	var passcont = /^[a-zA-Z0-9_-]{6,15}$/;


	var verifyname = namecont.test(user);
	var verifypass = passcont.test(password);


	if(!verifyname){
		alert("Invalid username");
		return false;
	}
	if(!verifypass){
		alert("Invalid password");
		return false;
	}
	//var emailadd=document.forms["email"].value;
	var atpos=emailadd.indexOf("@");
	var dotpos=emailadd.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailadd.length){
	  alert("Not a valid e-mail address");
	  return false;
	}
	else{
		confirm("Login Successfully");
	}
}