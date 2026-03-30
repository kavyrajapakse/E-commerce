function ChangeView() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}

function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");
    var city = document.getElementById("city");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("e", email.value);
    f.append("pw", password.value);
    f.append("m", mobile.value);
    f.append("g", gender.value);
    f.append("c", city.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                swal("Sucessfully Signed Up", t, "success");

            } else {

                swal("oops", t, "warning");
            }

        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(f);
}

function logIn() {
    var email = document.getElementById("logemail");
    var password = document.getElementById("logpassword");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "home.php";
            } else {
                swal("oops", t, "warning");
            }

        }
    }

    r.open("POST", "logInProcess.php", true);
    r.send(f);

}

var bm;
function lostPassword() {

    var email = document.getElementById("logemail");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "Verification sent") {

                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showPassword() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';

    } else {
        np.type = "password";
        npb.innerHTML = '<i class="bi bi-eye"></i>';
    }

}

function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';

    } else {
        rnp.type = "password";
        rnpb.innerHTML = '<i class="bi bi-eye"></i>';
    }

}

function resetPassword() {

    var email = document.getElementById("logemail");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("np", np.value);
    f.append("rnp", rnp.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                bm.hide();
                swal("Sucessfully changed", t, "success");
                window.location.reload();

            } else {
                swal("oops", t, "warning");
            }

        }
    }

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);

}

function signOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "signOutProcess.php", true);
    r.send();
}

function showPassword3() {

    var pw = document.getElementById("pw");
    var pwb = document.getElementById("pwb");

    if (pw.type == "password") {
        pw.type = "text";
        pwb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        pw.type = "password";
        pwb.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}

//function updateProfile() {

    //var profile_img = document.getElementById("profileImage");
    //var first_name = document.getElementById("fname");
    //var last_name = document.getElementById("lname");
    //var mobile_no = document.getElementById("mobile");
    //var password = document.getElementById("pw");
    //var email_address = document.getElementById("email");
    //var address_line_1 = document.getElementById("line1");
    //var address_line_2 = document.getElementById("line2");
    //var city = document.getElementById("city");
    //var postal_code = document.getElementById("pc");

    //var f = new FormData();
    //f.append("img", profile_img.files[0]);
    //f.append("fn", first_name.value);
    //f.append("ln", last_name.value);
    //f.append("mn", mobile_no.value);
    //f.append("pw", password.value);
    //f.append("ea", email_address.value);
    //f.append("al1", address_line_1.value);
    //f.append("al2", address_line_2.value);
    //f.append("c", city.value);
    //f.append("pc", postal_code.value);

    var r = new XMLHttpRequest();

    //r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                signOut();
                // window.location = "home.php";
            } else {
                alert(t);
            }

        }
   // }

    //r.open("POST", "userProfileUpdateProcess.php", true);
    //r.send(f);

//}

function updateMyProfile(){
    //alert("hi");
    var img=document.getElementById("profileimage").value;
    var f=document.getElementById("profilefname").value;
    var l=document.getElementById("profilelname").value;
    var m=document.getElementById("profilemob").value;
    var a1=document.getElementById("profileadd1").value;
    var a2=document.getElementById("profileadd2").value;
    var p=document.getElementById("profileProvince").value;
    var d=document.getElementById("profileDistrict").value;
    var c=document.getElementById("profileCity").value;
    //alert(img);
    var form=new FormData();
    form.append("img",img);
    form.append("f",f);
    form.append("l",l);
    form.append("m",m);
    form.append("a1",a1);
    form.append("a2",a2);
    form.append("p",p);
    form.append("d",d);
    form.append("c",c);

    var r=new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="User Profile Updated"){
                swal("success", t, "success");
                window.reload();
            }
        }
          
    }
    
    r.open("POST","updateMyProfieProcess.php",true);
    r.send(form);
}

function changeProductImage() {

    var images = document.getElementById("imageuploader");

    images.onchange = function () {

        var file_count = images.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + "Files uploaded. You are proceed to upload 3 or less than 03 files");
        }
    }
}

function addProduct() {

    var title = document.getElementById("title");
    var desc = document.getElementById("desc");
    var category = document.getElementById("category");
    var size = document.getElementById("size");
    var condition = document.getElementById("con");
    var color = document.getElementById("color");
    var cost = document.getElementById("cost");
    var qty = document.getElementById("qty");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("desc", desc.value);
    f.append("ca", category.value);
    f.append("s", size.value);
    f.append("cond", condition.value);
    f.append("col", color.value);
    f.append("cost", cost.value);
    f.append("qty", qty.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "PRODUCT ADDED SUCESSFULLY") {
                swal("success", t, "success");
                window.location.reload();
            } else {
                swal("oops", t, "warning");
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}

function changeStatus(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "activated" || t == "deactivated") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}

function sort(x) {

    var condition = document.getElementById("condition");
    var size = document.getElementById("size");
    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var f = new FormData();
    f.append("c", condition.value);
    f.append("sz", size.value);
    f.append("s", search.value);
    f.append("t", time);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            document.getElementById("sort").innerHTML = t;

        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);
}

function clearSort() {
    window.location.reload();

}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}

function updateProduct() {
    var title = document.getElementById("title");
    var description = document.getElementById("desc");
    var price = document.getElementById("cost");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("d", description.value);
    f.append("c", price.value);
    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("i" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "myProducts.php";
            } else if (t == "Invalid Image Count") {

                if (confirm("Don't you want to update Product Images?") == true) {
                    window.location = "myProducts.php";
                } else {
                    alert("Select images.");
                }
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);
}

function basicSearch(x) {
    var text = document.getElementById("kw").value;
    var select = document.getElementById("c").value;

    var f = new FormData();
    f.append("t", text);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }

    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}

function advancedSearch(x) {
    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var size = document.getElementById("s1");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s2");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("sz", size.value);
    f.append("pf", from.value);
    f.append("pt", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }else{
            document.getElementById("view_area").innerHTML = "No items to display";
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);
}

function loadMainImg(id) {

    var new_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + new_img + ")";


}

function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Added to the watchlist") {
                //alert("Product added to the watchlist successfully");
                swal("success", t, "success");
        
            } else if (t == "Removed from the watchlist") {
                swal("oops", t, "warning");
        
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addWatchlistProcess.php?id=" + id, true);
    r.send();

}

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "deleted") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromWatchlistProcess.php?id=" + id, true);
    r.send();
}

function change2(){
    var description1 = document.getElementById("description");
    var shipping = document.getElementById("shipping");

    shipping.classList.toggle("d-none");
    description1.classList.toggle("d-none");
}


var av;
function adminVerification(){
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e",email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            }else{
                swal("oops", t, "warning");
            }
        }
    }

    r.open("POST","adminVerificationProcess.php",true);
    r.send(f);
}

function verify(){
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
                av.hide();
                window.location = "adminDashboard.php";
            }else{
                alert (t);
            }
            
        }
    }

    r.open("GET","verificationProcess.php?v="+verification.value,true);
    r.send();
}


function loadUser(){
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            //alert(response);
            document.getElementById("tb").innerHTML = response;
        }
    }

    request.open("POST","loadUserProcess.php",true);
    request.send();
}

function blockUser(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("ub"+email).innerHTML = "Unblock";
                document.getElementById("ub"+email).classList = "btn btn-danger";
                window.location.reload();
            }else if(txt == "unblocked"){
                document.getElementById("ub"+email).innerHTML = "Block";
                document.getElementById("ub"+email).classList = "btn btn-outline-danger";
                window.location.reload();
            }else{
                alert (txt);
            }
        }
    }

    request.open("GET","userBlockProcess.php?email="+email,true);
    request.send();

}

function searchUser(){
    //alert("ok");
    var email = document.getElementById("e");
    
}

function loadProducts(x){
    //alert(x);
    var page = x;

    var f = new FormData();
    f.append("p",page);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            //alert(response);
            document.getElementById("bt").innerHTML = response;

        }
    }

    request.open("POST","loadProductProcess.php",true);
    request.send(f);
}

function blockProduct(id){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "SoldOut"){
                document.getElementById("bu"+id).innerHTML = "Available";
                document.getElementById("bu"+id).classList = "btn btn-danger";
                window.location.reload();
            }else if(txt == "Available"){
                document.getElementById("bu"+id).innerHTML = "Sold Out";
                document.getElementById("bu"+id).classList = "btn btn-outline-danger";
                window.location.reload();
            }else{
                alert (txt);
            }
        }
    }

    request.open("GET","productBlockProcess.php?id="+id,true);
    request.send();

}

function addToCart(x){
    //alert(x);
    var productid = x;

    var f = new FormData();
    f.append("p",productid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function(){
        if(r.readyState == 4 && r.status == 200){
            var t = r.responseText;
            //alert(response);
            if (t == "Product is Added to the cart") {
                swal("success", t, "success");
            } else if (t == "REMOVED") {
                 swal("oops", t, "warning");
            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgDiv").className = "d-block";
            }
        }
    }

    r.open("POST","addtoCartProcess.php",true);
    r.send(f);
}

function removeFromCart(id){
    //alert(x);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "deleted") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCartProcess.php?id=" + id, true);
    r.send();
}

function checkOut(){
    //alert("ok");

    var f = new FormData();
    f.append("cart",true);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function (){
        if(r.readyState == 4 && r.status == 200){
            var response = r.responseText;
            //alert(response);
            var payment = JSON.parse(response);
            doCheckout(payment,"checkoutProcess.php");
        }
    }

    r.open("POST","paymentProcess.php",true);
    r.send(f);

}

function doCheckout(payment, path){

    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);

        saveInvoice(orderId);
        // Note: validate the payment and show success or failure page to the customer

        var f = new FormData();
        f.append("payment", JSON.stringify(payment));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var response = request.responseText;
                //alert(response);
                if(response == "success"){
                    reload();
                }else{
                    alert(response);
                }
            }
        }

        request.open("POST", path, true);
        request.send(f);

    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };


    // Show the payhere.js popup, when "PayHere Pay" is clicked
    //document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
    //};
        
}

function buyNow(productId){
   // alert(productId);
   var f = new FormData();
   f.append("cart",false);
   f.append("productId",productId);

   
   var r = new XMLHttpRequest();
    r.onreadystatechange = function (){
        if(r.readyState == 4 && r.status == 200){
            var response = r.responseText;
            //alert(response);
            var payment = JSON.parse(response);
            payment.product_id = productId;
            doCheckout(payment,"buyNowProcess.php");
        }
    }


   r.open("POST","paymentProcess.php",true);
   r.send(f);


}

function saveInvoice(orderId){

    var f = new FormData();
    f.append("o",orderId);
    
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){

                window.location = "invoice.php?pid="+orderId;

            }else{
                alert (t);
            }
        }
    }

    r.open("POST","saveInvoice.php",true);
    r.send(f);

}

function loadpro(x){
    var page = x;
    window.location = "allProducts.php?page="+page;


}

function productPage (){
    alert("ok");
}

function loadRecentProducts(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            //alert(response);
            document.getElementById("rp").innerHTML = response;
        }
    }

    request.open("POST","loadRecentProcess.php",true);
    request.send();
}




function userReport(){
    window.location = "userReport.php";
}

function productReport(){
    window.location = "productReport.php";
}

function oIReport(){
    window.location = "orderItemReport.php";
}

function oHReport(){
    window.location = "orderHistoryReport.php";
}

function adminOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "adminOutProcess.php", true);
    r.send();
}