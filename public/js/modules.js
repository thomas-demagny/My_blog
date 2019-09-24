function modules() {
    var signup_password = document.getElementById("signup_password").value;
    var confirmpassword = document.getElementById("confirmpassword").value;
    if (signup_password !== confirmpassword) {
        document.getElementById("msg").innerHTML = "Les deux mots de passe doivent être identiques";
        document.getElementById("msg").style.color = "red";
    } else {
        document.getElementById("msg").innerHTML = "Valide";
        document.getElementById("msg").style.color = "green";
    }
}


//switch tabs in admin
    $('#adminTab a').on('click', function (admin) {
        admin.preventDefault();
        $(this).tab('show')
    });




