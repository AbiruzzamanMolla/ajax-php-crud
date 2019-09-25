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

// loading data to index page
$(document).ready(function () {
    loadData();
});
// loading data function
function loadData() {
    $.ajax({
        url: 'bend/read.php',
        method: 'GET',
        success: function (responce) {
            responce = $.parseJSON(responce);
            if (responce.status == 'success') {
                $('#dataTable').html(responce.table);
            }
        }
    });
}

// getting data form input form of create data
$(document).ready(function () {
    $('#form1').on('submit', function (e) {
        e.preventDefault();
        var form = $("#form1");
        var data = $("#form1").serialize();
        if(validate(form)){
            createData(data);
        } else {
            var alert = $('#alert2');
            alert.addClass('alert');
            alert.addClass('alert-warning');
            alert.html('Please fill all form!');
        }
    });
});

// function to create data and save to database and send response
function createData(data) {
    $.ajax({
        url: 'bend/add.php',
        type: 'POST',
        data: data,
        success: function (responce) {
            responce = $.parseJSON(responce);
            // condition for alert and load data
            if (responce.status == 'success') {
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
            // loading data
            loadData();
        }
    });
}


// checking table click data to purform delete or edit or vide action
$(function () {
    $('table').on('click', function (e) {
        e.preventDefault();
        var tag = $(e.target).parent('#update');
        var id = tag.attr('data-id');
        if (tag.hasClass('edit')) {
            getData(id);
        }
        var dTag = $(e.target).parent('#delete');
        var dId = dTag.attr('data-id');
        if (dTag.hasClass('delete')) {
            deleteData(dId);
        }
        
        var vTag = $(e.target).parent('#view');
        var vId = vTag.attr('data-id');
        if (vTag.hasClass('view')) {
            viewData(vId);
        }
    });
});
// getting data to show
function getData(id) {
    $.ajax({
        url: 'bend/getData.php',
        method: 'post',
        data: {
            id: id
        },
        success: function (responce) {
            // responce = $.parseJSON(responce);
            responce = JSON.parse(responce);
            if (responce.status == 'success') {
                var modal = $('#editModal');
                var form = modal.find('#form2');
                form.find('#id').val(responce[0].id);
                form.find('#fname').val(responce[0].fname);
                form.find('#lname').val(responce[0].lname);
                form.find('#email').val(responce[0].email);
                form.find('#gender').val(responce[0].gender);
                form.find('#dob').val(responce[0].dob);
                form.find('#dob').val(responce[0].dob);
                form.find('#education').val(responce[0].education);
                form.find('#address').val(responce[0].address);
                form.find('#bio').val(responce[0].bio);
            }

        }
    });
}

//updating data
function updateData(data) {
    $.ajax({
        url: 'bend/edit.php',
        type: 'POST',
        data: data,
        success: function (responce) {
            responce = $.parseJSON(responce);
            // condition for alert and load data
            if (responce.status == 'success') {
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
            // loading data
            loadData();
        }
    });
}
// sending data if submit button clicked in form2 or data editing
$(document).ready(function () {
    $('#form2').on('submit', function (e) {
        e.preventDefault();
        var data = $("#form2").serialize();
        updateData(data);
    });
});

// delete function load
function deleteData(id) {
    $('#form3').on('submit', function (e) {
        e.preventDefault();

        console.log(id);
        $.ajax({
            url: 'bend/delete.php',
            method: 'post',
            data: {
                id: id
            },
            success: function (responce) {
                responce = $.parseJSON(responce);
                // condition for alert and load data
                if (responce.status == 'success') {
                    var alert = $('#alert');
                    alert.addClass('alert');
                    alert.addClass('alert-danger');
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
                    alert.addClass('alert-warning');
                    alert.html(responce.message);
                }
                // loading data
                loadData();
            }
        });
    });
}
// hide modal

function modalHide() {
    $('.modal').each(function () {
        e.preventDefault();
        $(this).modal('hide');
    });
}

// view data 

// getting data to show
function viewData(id) {
    $.ajax({
        url: 'bend/getData.php',
        method: 'post',
        data: {
            id: id
        },
        success: function (responce) {
            responce = $.parseJSON(responce);
            if (responce.status == 'success') {
                var modal = $('#viewModal');

                modal.find('#fname').html(responce[0].fname);
                modal.find('#lname').html(responce[0].lname);
                modal.find('#email').html(responce[0].email);
                modal.find('#gender').html(responce[0].gender);
                modal.find('#dob').html(responce[0].dob);
                modal.find('#edu').html(responce[0].edu);
                modal.find('#address').html(responce[0].address);
                modal.find('#bio').html(responce[0].bio);
            }

        }
    });
}
// form validation check
function validate(form){
    var inputTag = form.find('input');
    for(var i = 0; i< inputTag.length; i++){
        if(inputTag[i].value == '' || inputTag[i].value == null){
            return false;
        }
    }
    return true;
}