// script for the month_calendar.php page

var table = document.getElementById("mc_table");
var data_month = document.getElementById("month").value;
var data_year = document.getElementById("year").value;
var data_id = document.getElementById("id").value;
var sql_data = document.getElementById("data").value;
var parse_data = JSON.parse(sql_data);

var days_of_the_week = ["Sun", "Mon", "Tues", "Wed", "Thur", "Fri", "Sat"];
var months_array = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "Novevember", "December"];
var month_num = months_array.indexOf(data_month);

var days_in_month = daysInMonth(month_num, data_year);

// add body
table.appendChild(document.createElement('tbody'));
var cal_array = getCalendarArray(month_num, data_year, days_in_month);

addRowCell(cal_array, table)

// Add header row
var header = table.createTHead();
addRowCell(days_of_the_week, header);

// function ajaxCall(data_args, call_type, url) {
//     return Promise.resolve($.ajax({
//         method: call_type,
//         url: url,
//         data: data_args,
//         dataType: 'json'
//     }));
// }

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
    return cal_array;
}

// Adds a row and a cell (including content) to the table
// If the passed in element is a table, this assumes an element to the tbody is being added
// If it's a tbody, then check to see if Daily Sum needs to be added to the day
function addRowCell(data, element) {
    var row = element.insertRow(0); //insert row
    var d_len = data.length;
    for (var j = 0; j < d_len; j++) {
        var cell = row.insertCell(j);
        let day = data[j];
        let value1 = document.createTextNode(day);
        cell.appendChild(value1);
        if (data[j] !== ' ' && element.nodeName === 'TABLE') {
            cell.addEventListener('click', function () {
                clickTD(day);
            });
            cell.style.cursor = "pointer";
        }

        // If table element, check sql data array for daily sum to be added
        // Only add daily sum if "day" equals the current day
        if (element.nodeName === 'TABLE' && day !== ' '
            && parse_data.some(item => item.Day === day)) {
            let daily_sum = returnDailySum(day);
            let h3 = document.createElement('h2');
            // set id attribute to figure out all of the days that have daily sum
            //h3.setAttribute()
            h3.innerText = daily_sum;
            cell.appendChild(h3);
        }

    }
}

// Returns the Daily Sum value from the sql data array
function returnDailySum(day) {
    var result = parse_data.filter(x => x.Day === String(day));
    return String(result[0].DailySum);
}

function clickTD(day) {
    // let data = data_id + "_" + day + "_" + data_month + "_" + data_year;
    let data = day;
    let href_link = "add_dailyhours.php?data=" + data;
    window.location.href = href_link;
}

