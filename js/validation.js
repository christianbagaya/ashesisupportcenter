//the javascript code for email validation. Our system is limited to only ashesi emails
function ValidateEmail(inputText) {
    var mailformat = /\w+@ashesi\.edu\.gh/;

    if (inputText.value.match(mailformat)) {
        document.form1.text1.focus();
    }
    else {
        alert("You have entered an invalid email address, use your ashesi email!");
        document.form1.text1.focus();
        return false;
    }
}


function callValidator() {
    inputText = document.querySelector('#exampleInputEmail1');
    ValidateEmail(inputText);
}
