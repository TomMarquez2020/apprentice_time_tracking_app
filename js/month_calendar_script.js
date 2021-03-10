// script for the month_calendar.php page

var table = document.getElementById("mc_table");
var month = document.getElementById("month").value;
var year = document.getElementById("year").value;

var days_of_the_week = ["Sun", "Mon", "Tues", "Wed", "Thur", "Fri", "Sat"];
var months_array = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "Novevember", "December"];
var month_num = months_array.indexOf(month);

var days_in_month = daysInMonth(month_num, year);

// Return the total number of days in the month
function daysInMonth(month, year) {
    return new Date(year, month + 1, 0).getDate();
}

// add body
table.appendChild(document.createElement('tbody'));
var cal_array = getCalendarArray(month_num, year, days_in_month);

addRowCell(cal_array, table, 0)

// Add header row
var header = table.createTHead();
addRowCell(days_of_the_week, header, 0);

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

function addRowCell(data, element, num_of_rows) {
    for (var i = 0; i <= num_of_rows; i++) {
        var row = element.insertRow(i)
        var d_len = data.length;
        for (var j = 0; j < d_len; j++) {
            var cell = row.insertCell(j);
            cell.innerHTML = data[j];
        }
    }
}
