// Name validation
function nameCheck() {
    //select all id
    var fname = document.querySelector('#fname');
    var flen = fname.value.length;
    var lname = document.querySelector('#lname');
    var llen = lname.value.length;

    // other selections
    var wfname = document.querySelector('#wfname');
    var name = fname.value + lname.value;

    if (name.length > 30 || name.length <= 2) {
        wfname.innerHTML = "Name can't be more then 30 letter or less then 2 letter!";
        fname.classList.add('is-invalid');
        lname.classList.add('is-invalid');
    } else {
        wfname.innerHTML = "";
        fname.classList.remove('is-invalid');
        lname.classList.remove('is-invalid');
        if (flen < 30) {
            fname.classList.add('is-valid');
        } else {
            fname.classList.remove('is-valid');
        }
        if (llen < 30) {
            lname.classList.add('is-valid');
        } else {
            lname.classList.remove('is-valid');
        }
    }
}
// email validation
function validateemail() {
    var x = document.querySelector('#email').value;
    var wemail = document.querySelector('#wemail');
    var atposition = x.indexOf("@");
    var dotposition = x.lastIndexOf(".");
    if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
        wemail.innerHTML = "Enter Valid email";
        document.querySelector('#email').classList.remove('is-valid');
        document.querySelector('#email').classList.add('is-invalid');
    } else {
        wemail.innerHTML = "";
        document.querySelector('#email').classList.remove('is-invalid');
        document.querySelector('#email').classList.add('is-valid');
    }
}

// password validation
function passVal() {
    var password = document.querySelector('#password1');
    var password2 = document.querySelector('#password2');
    var passLen = password.value.length;
    var wpass = document.querySelector('#wpass');
    if (passLen > 30 || passLen < 6) {
        wpass.innerHTML = "Password can't be more than 30 character or less then 6 charecter!";
        document.querySelector('#password1').classList.remove('is-valid');
        document.querySelector('#password1').classList.add('is-invalid');
        x = true;
    } else {
        wpass.innerHTML = "";
        document.querySelector('#password1').classList.remove('is-invalid');
        document.querySelector('#password1').classList.add('is-valid');
    }
    if (password.value !== password2.value) {
        wpass.innerHTML = "Password not matched";
    }

}


$(document).ready(function(){
    loadData();
});

$(document).ready(function () {
    $('#form1').on('submit', function(e){
        e.preventDefault();
            var data = $("#form1").serialize();
;            createData(data);
    });
});

function createData(data){
        $.ajax({
            url: 'bend/add.php',
            type: 'POST',
            data: data,
            success: function(responce){
                responce = $.parseJSON(responce);
                if(responce.status == 'success'){
                    var alert = $('#alert');
                    alert.addClass('alert');
                    alert.addClass('alert-success');
                    alert.html(responce.message);
                    $('.modal').each(function () {
                        $(this).modal('hide');
                    });
                    $("#alert").fadeTo(2000, 500).slideUp(500, function () {
                        $("#alert").slideUp(500);
                    });
                } else {
                    var alert = $('#alert');
                    alert.addClass('alert');
                    alert.addClass('alert-danger');
                    alert.html(responce.message);
                }
                loadData();
                console.log(responce);
            }
        });
}

function loadData(){
    $.ajax({
        url: 'bend/read.php',
        method: 'GET',
        success: function(responce){
            responce = $.parseJSON(responce);
            if(responce.status == 'success'){
                $('#dataTable').html(responce.table);
            }
        }
    });
}

// Alert auto close
