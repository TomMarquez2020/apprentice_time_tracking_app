// this may not

// loop through inputs and add event listener
// this will be used for error checking
// error checking includes: 
//      - only allow ints for values
//      - if a value exists and user removes value, input "0" and delete on the server
//      - check to see that sum of all hours is not over 24

const validateValue = (item, before_value) => {
    return (e) => {
        const sumOfValues = getTotal();
        console.log(sumOfValues);
        const after_value = e.target.value;
        const textfield = document.getElementById(item.id);
        if (after_value.trim() === "") {
            textfield.value = 0;
        }
        else if (isNaN(after_value) || sumOfValues >= 24) {
            textfield.value = before_value;
        }
    }
}
document.querySelectorAll('.ad_table_cell input').forEach(item => {
    // save before value before passing into event
    // this allows field to revert to original value
    const before_value = item.value;
    item.addEventListener('change', validateValue(item, before_value));
})

// find total of all input values
function getTotal() {
    // grab all input elemens
    var inputs = document.getElementsByTagName('input');
    var arr = [];
    for (var j = 0; j < inputs.length; j++) {
        var ele = inputs[j];
        // grab the name attribute
        var attr = inputs[j].getAttribute('name');
        var val = ele.value;
        // only add values from inputs that have a name beginning with 'hours'
        if (attr && attr.indexOf('hours') == 0) {
            const intVal = parseInt(val);
            // push to array only if it is an integer
            if (!isNaN(intVal)) {
                arr.push(intVal);
            }
        }
    }
    var total = 0;
    for (var i = 0; i < arr.length; i++) {
        total += arr[i];
    }
    return total;
}