/* This func checks all the possible cases so 
the client don't break the program */
function verificate(){
    // Converting from human Readable to unix epoch
    const startUnix = humanToUnix(startInput.value);
    const endUnix = humanToUnix(endInput.value);
    // Storage the values in global variables
    startValue = startUnix;
    endValue = endUnix;
    // Get the actual time
    const currentTime = Math.floor(new Date().getTime()/1000.0);

    const {proceed, message} = isRangePossible(startValue, endValue, currentTime);

    if(proceed){
        /* Search data */
        console.log("Searching Data! start:"+startValue+" end:"+endValue);
    }else{
        alert(message);
    }
}
// This func converts from human Readable to unix epoch
function humanToUnix(human){
    let Epoch;
    // If there's no input, just return null
    if (human!=""){
        const newDate = new Date(human);
        Epoch = newDate.getTime()/1000.0;
    }else{
        Epoch = null
    }
    return Epoch
}
// This func checks if the range is possible
function isRangePossible(start, end, current){
    // By default the program should not proceed until the conditions are checked
    let proceed = false;
    let message;
    // Evaluate the possible cases
    switch(true){
        //The user didn't input some required data
        case (start == null || end == null):
            message = "Please enter required data!"
            break;
        //The user input incoherent data
        case (start < 0 || end < 0):
            message = "Please enter coherent data!"
            break;
        //The user input impossible range
        case (start > end):
            message = "Start should not be greater than end!";
            break;
        //The user input future time
        case (end > current):
            message = "End should not be greater than current time!"
            break;
        //Everithing is ok
        case (start <= end):
            proceed = true;
            break;
    }
    return {proceed, message};
}

const button = document.querySelector(".searchData");
const startInput = document.querySelector("#startTime");
const endInput = document.querySelector("#endTime");

let startValue;
let endValue;