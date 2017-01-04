// intended to be ran in JSC
debug("Please enter 2 numbers seperated by a space:")
var ints = readline().split(/\ +/);

debug(parseInt(ints[0]) + parseInt(ints[1]));
