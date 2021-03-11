// script for the month_calendar.php page

var table = document.getElementById("mc_table");
var month = document.getElementById("month").value;
var year = document.getElementById("year").value;
var id = document.getElementById("id").value;

// get progress hours data
// Todo: the ajax data call isn't completely working...it's an async issue
var ajax_data = { id: id, month: month, year: year };
var url = 'data/get_Progress_hours.php';
var sql_data_ajax = ajaxCall(ajax_data, 'GET', url);
var sql_data = "";
sql_data_ajax.then(data => sql_data);

console.log(sql_data_ajax);
console.log(sql_data);

var days_of_the_week = ["Sun", "Mon", "Tues", "Wed", "Thur", "Fri", "Sat"];
var months_array = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "Novevember", "December"];
var month_num = months_array.indexOf(month);

var days_in_month = daysInMonth(month_num, year);

// add body
table.appendChild(document.createElement('tbody'));
var cal_array = getCalendarArray(month_num, year, days_in_month);

addRowCell(cal_array, table)

// Add header row
var header = table.createTHead();
addRowCell(days_of_the_week, header);

function ajaxCall(data_args, call_type, url) {
    return Promise.resolve($.ajax({
        method: call_type,
        url: url,
        data: data_args,
        dataType: 'json'
    }));
}

// function ajaxCall(data, call_type, url) {
//     const xmlhttp = new XMLHttpRequest();
//     const new_url = url + '?id=' + data[0] + '&month=' + data[1] + '&year=' + data[2];

//     var sql_data = [];

//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && xmlhttp.readyState == XMLHttpRequest.DONE) {
//             sql_data = setSqlData(xmlhttp.responseText, sql_data);

//         }
//     }
//     xmlhttp.open(call_type, new_url, true);
//     xmlhttp.send(null);

//     return sql_data;
// }

function setSqlData(ajaxResponse, sql_data) {
    sql_data = ajaxResponse;
    return sql_data;

}

// Return the total number of days in the month
function daysInMonth(month, year) {
    return new Date(year, month + 1, 0).getDate();
}

function getCalendarArray(month_num, year, days_in_month) {
    var cal_array = [];
    // 42 days in our calendar month
    var day_of_cal_array = 42;
    var day_of_month = 1;
    var month_array = [];
    for (var i = 0; i < days_in_month; i++) {
        var day_num = new Date(year, month_num, day_of_month);
        day_num = day_num.getDay();
        month_array[i] = day_num;
        day_of_month += 1;
    }
    //console.log(month_array);
    month_array_index = 0;
    for (var i = 0; i < day_of_cal_array; i++) {
        if ((i % 7) !== parseInt(month_array[month_array_index]) || typeof month_array[month_array_index] === 'undefined') {
            cal_array[i] = ' ';
        }
        else {
            cal_array[i] = (month_array_index + 1).toString();
            month_array_index += 1;
        }
    }
    //console.log(cal_array);
    return cal_array;
}

function addRowCell(data, element) {
    var row = element.insertRow(0)
    var d_len = data.length;
    var num_dimension = data.filter(Array.isArray).length; // if data is a multi dimensional array
    for (var j = 0; j < d_len; j++) {
        var cell = row.insertCell(j);
        cell.innerHTML = data[j];
    }
}
