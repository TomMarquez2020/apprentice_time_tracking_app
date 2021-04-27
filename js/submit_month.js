$(function () {
    // use ajax to check supervisor code

    // get apprentice id
    const apprentice_id = document.getElementById('apprentice_id').value;

    $('#submit_month_form').click(function (e) {
        console.log("hello");

        $.get("check_supervisorcode.php",
            {
                id: apprentice_id,
                supcode: this.value
            },
            function (data, status) {
                alert("data: " + data + "\nStatus: " + status);
            });
        e.preventDefault();
    });

});

