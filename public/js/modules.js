function modules() {
    var signupPassword = document.getElementById("signupPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    if (signupPassword !== confirmPassword) {
        document.getElementById("msg").innerHTML = "Les deux mots de passe doivent être identiques";
        document.getElementById("msg").style.color = "red";
    } else {
        document.getElementById("msg").innerHTML = "Valide";
        document.getElementById("msg").style.color = "green";
    }
}


//switch tabs in admin
    $("#adminTab a").on("click", function (admin) {
        admin.preventDefault();
        $(this).tab("show");
    });







