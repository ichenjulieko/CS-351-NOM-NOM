<script type="text/javascript">
function validateform(){
var firstname = document.getElementById('fname').value;
//var firstname=document.["fname"].value;
if (firstname===null || firstname==="")
  {
  alert("First name must be filled out");
  return false;
  }
}

// function validateemail()
// {
// var x=document.forms["myForm"]["email"].value;
// var atpos=x.indexOf("@");
// var dotpos=x.lastIndexOf(".");
// if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
//   {
//   alert("Not a valid e-mail address");
//   return false;
//   }
// }
</script>