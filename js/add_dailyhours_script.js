// this may not

// loop through inputs and add event listener
// this will be used for error checking
// error checking includes: 
//      - only allow ints for values
//      - if a value exists and user removes value, input "0" and delete on the server
//      - check to see that sum of all hours is not over 24

const validateValue = (item, before_value) => {
    return (e) => {
        const after_value = e.target.value;
        const textfield = document.getElementById(item.id);
        if (after_value.trim() === "") {
            textfield.value = 0;
        }
        else if (isNaN(after_value)) {
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

// function validateValue(e, before_val) {
//     // var value = e.target.value;
//     console.log("before value: " + before_val);
//     console.log("after value: " + e);
// }