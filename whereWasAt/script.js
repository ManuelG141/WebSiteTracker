// Include the inputs and containers from the HTML file
const divMap = document.getElementById("map");
const pResult = document.querySelector("#result");
const button = document.querySelector(".searchData");
const startInput = document.querySelector("#startTime");
const endInput = document.querySelector("#endTime");

// Variables to later store the latitude, longitude, and timeStamp data
var latitude = [];
var longitude = [];
var timeStamp = [];

// This func converts from human Readable to unix epoch
function humanToUTCUnix(human){
    //If the input is empty, then return null
    if (human === "") {
        return null;
      }
    //If not then convert to Unix UTC epoch
    let newDate = new Date(human);
    let Epoch = newDate.getTime();
    return Epoch;
}
/* This func checks all the possible cases so 
the client don't break the program */
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

// If someone submit the from, then do what's inside of this
document.getElementById("searchForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Converting from human Readable to unix epoch
    const startUnix = humanToUTCUnix(startInput.value);
    const endUnix = humanToUTCUnix(endInput.value);
    // Get the actual time
    const currentTime = humanToUTCUnix(new Date().getTime());

    // Printing info in the nav console
    console.log("Start value: "+startUnix);
    console.log("End Value: "+endUnix);
    console.log("Current Time:"+currentTime);
    // Checking if the inputs are ok
    const {proceed, message} = isRangePossible(startUnix, endUnix, currentTime);
    // If all is ok the proceed
    if(proceed){
        /* Search data */
        console.log("Searching Data! start:"+startUnix+" end:"+endUnix);
        // Search the data in data base over the php script, post method
        fetch("../includes/requestHistoryData.php", {
            method: "POST",
            body: new URLSearchParams({
                startTime: startUnix,
                endTime: endUnix
            })
        })
        .then(response => response.json())
        .then(data => {
            // Reset the vectors before saving the data
            latitude = [];
            longitude = [];
            timeStamp = [];
            // Save the values in latitude, longitude and timeStamp
            // Vectors
            data.forEach(item => {
                latitude.push(item.latitude);
                longitude.push(item.longitude);
                timeStamp.push(item.timeStamp);
            });
            // Print the vectors in the nav console
            console.log("Latitude Array:", latitude);
            console.log("Longitude Array:", longitude);
            console.log("TimeStamp Array:", timeStamp);

            if (latitude.length > 1 && longitude.length > 1){
                //Hide the result, so there's no need to show it
                pResult.style.visibility = "hidden";
                //Make visible the map now that there's data to display
                divMap.style.visibility = "visible";
                // Make the polyline in the map
                makePoly(latitude, longitude);
            } else {
                //Show result and hide the map
                pResult.style.visibility = "visible";
                pResult.textContent = "There is no result between "+startInput.value+" and "+endInput.value;
                divMap.style.visibility = "hidden";
            }

        }).catch(error => console.error("Error:", error));
    }else{
        /* In the case there's some problem with the inputs of the user
        then print the message in the screen using a alert*/
        alert(message);
    }
});