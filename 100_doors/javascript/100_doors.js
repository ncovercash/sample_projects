// output
var log = function(i) {
    if (console == undefined) {
        debug(i);
    } else {
        console.log(i);
    }
} 

// toggle a boolean
var toggle = function(item) {
    if (item) { // do not need to check if bool due to arg
        return false;
    } else {
        return true;
    }
}

// initialize array of 100 doors, all closed or false
var doors = Array(100).fill(false);

var step = 1;
while (step <= doors.length) {
    for (i = step-1; i < doors.length; i+=step) {
        doors[i] = toggle(doors[i]);
    }
    step += 1;
}

// print raw contents
log("Raw array contents");
log(doors);

// loop through, find closed (false) indecies
log("");
log("Closed doors:");
var s = "[ ";
for (var x = 0; x < doors.length; x++) {
    if (doors[x] == false) {
        s += (x+1)+" ";
    }
}
s += "]"; // close it
log(s);

// loop through, find open (true) indecies
log("");
log("Open doors:");
var s = "[ ";
for (var x = 0; x < doors.length; x++) {
    if (doors[x] == true) {
        s += (x+1)+" ";
    }
}
s += "]"; // close it
log(s);
