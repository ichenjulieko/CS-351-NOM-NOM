/*
	Eric Dong
	CS 351 Team Project
	Partner: Julie(Ichen) Ko
*/

function Validate() {
	var name = document.getElementById("name");
	var pass = document.getElementById("pass");
	var confPass = document.getElementById("confPass");
	var email = document.getElementById("email");

	var errorMsg = "";

	//	Check if any are empty
	if(name.value == "" || pass.value == "" || confPass.value == "" || email.value == "") {
		alert("Please fill in all fields.");
		return;
	}

	//	Check for invalid username
	if(name.value.length < 3) {
		errorMsg += "Invalid username: must be at least 3 characters long.\n";
		name.value = "";
	}
	
	//	Check for mismatched passwords
	if(pass.value != confPass.value) {
		errorMsg += "Passwords are not matching.\n";
		pass.value = "";
		confPass.value = "";
	}

	//	Check for invalid email
	regex = /.+@.+\..+/;
	if(email.value.match(regex) == null) {
		errorMsg += "Invalid email."
		email.value = "";
	}

	//	Successful sign up
	if(errorMsg.length == 0) {
		var choice = confirm("You have been signed up with the information:\nName: " + name.value + "\nEmail: " + email.value + "\nPassword: " + pass.value);

		// if(choice)
		// 	window.open("Vote.html", "_self", false);
		// else {
		// 	name.value = "";
		// 	pass.value = "";
		// 	confPass.value = "";
		// 	email.value = "";
		// }
	}
	//	Error in info
	else {
		errorMsg = "Error:\n\n" + errorMsg;
		alert(errorMsg);
	}
}