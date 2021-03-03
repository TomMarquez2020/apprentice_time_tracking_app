
// create calendar table 
var table = document.getElementById("year_calendar");

// add date to caption
// NOTE: that this is the date of the user's device, not of the database. This may need to be changed eventually
var date = new Date;
var year = date.getFullYear();
var month = date.getMonth() + 1;
console.log(date);
var display_date = "<b>" + month + " " + date.getDate() + " " + year + "</b>";
var table_caption = table.createCaption();
table_caption.innerHTML = display_date;

var year_array = ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
var len = year_array.length;

// add body of table
row = table.insertRow();
for (var i = 0; i < len; i++) {
    var ele = row.insertCell(i);
    ele.innerHTML = '<input id="' + year_array[i] + year + '" type="button">';
}

// add row of th
var thead = table.createTHead();
var row = thead.insertRow();
for (let key of year_array) {
    let th = document.createElement("th");
    let text = document.createTextNode(key);
    th.appendChild(text);
    row.appendChild(th);
}


