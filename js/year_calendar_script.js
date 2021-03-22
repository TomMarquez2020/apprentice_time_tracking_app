
//////////////////////////////////////////////// create calendar table for year_calendar.php /////////////////////////////////////////
var table = document.getElementById("yc_year_calendar");
if (table) {
    var id = table.dataset.userid;

    var months_array = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novevember", "December"];

    // add date to caption
    // NOTE: that this is the date of the user's device, not of the database. This may need to be changed eventually
    var date = new Date;
    var year = date.getFullYear();
    var month = months_array[date.getMonth()];
    var display_date = "<h2>" + month + " " + date.getDate() + " " + year + "</h2>";
    var table_caption = table.createCaption();
    table_caption.innerHTML = display_date;

    var abr_months_array = ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
    var len = months_array.length;

    // add body of table
    row = table.insertRow();
    for (var i = 0; i < len; i++) {
        var ele = row.insertCell(i);
        var month = months_array[i].substring(0, 3);
        var year_id = months_array[i] + '_' + year;
        var href_link = "'month_calendar.php?data=" + year_id + "'";
        ele.innerHTML = '<input id="redirect_button" value="' + month + '"'
            + ' type="button" class="CalButton" onClick="location.href=' + href_link
            + ';">';
    }
}
/////////////////////////////////////////////// End Calendar table/////////////////////////////////////////////////
