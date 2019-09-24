function loadData() {
    $.ajax({
        url: 'bend/read.php',
        method: 'GET',
        success: function (responce) {
            console.log(responce);
        }
    });
}
