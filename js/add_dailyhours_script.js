// this may not

// loop through inputs and add event listener
// this will be used for error checking
// error checking includes: 
//      - only allow ints for values
//      - if a value exists and user removes value, input "0" and delete on the server
document.querySelectorAll('.ad_table_cell input').forEach(item => {
    item.addEventListener('change', validateValue);
})

function validateValue(e) {
    console.log(e.target.value);
}