# ahsesisuppcenter

//the javascript code for email validation
function ValidateEmail(inputText)
{
var mailformat = /\w+\.\w+@ashesi\.edu\.gh/;
if(inputText.value.match(mailformat))
{
document.form1.text1.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.form1.text1.focus();
return false;
}
}


//html code
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>JavaScript form validation - checking email</title>   
</head>
<body onload='document.form1.text1.focus()'>
<div class="mail">
<h2>Input an email and Submit</h2>
<form name="form1" action="#"> 
<ul>
<li><input type='text' name='text1'/></li>
<li>&nbsp;</li>
<li class="submit"><input type="submit" name="submit" value="Submit" onclick="ValidateEmail(document.form1.text1)"/></li>
<li>&nbsp;</li>
</ul>
</form>
</div>
<script src="email-validation.js"></script>
</body>
</html>
