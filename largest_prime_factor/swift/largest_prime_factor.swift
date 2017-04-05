// shamelessly from SO: http://stackoverflow.com/a/34322903/4236490 
// struct and stuff, straight from the above link
import CoreFoundation
// Usage:    var timer = RunningTimer.init()
// Start:    timer.start() to restart the timer
// Stop:     timer.stop() returns the time and stops the timer
// Duration: timer.duration returns the time
// May also be used with print(" \(timer) ")
struct RunningTimer: CustomStringConvertible {
    var begin:CFAbsoluteTime
    var end:CFAbsoluteTime

    init() {
        begin = CFAbsoluteTimeGetCurrent()
        end = 0
    }
    mutating func start() {
        begin = CFAbsoluteTimeGetCurrent()
        end = 0
    }
    mutating func stop() -> Double {
        if (end == 0) { end = CFAbsoluteTimeGetCurrent() }
        return Double(end - begin)
    }
    var duration:CFAbsoluteTime {
        get {
            if (end == 0) { return CFAbsoluteTimeGetCurrent() - begin } 
            else { return end - begin }
        }
    }
    var description:String {
    let time = duration
    if (time > 100) {return " \(time/60) min"}
    else if (time < 1e-6) {return " \(time*1e9) ns"}
    else if (time < 1e-3) {return " \(time*1e6) µs"}
    else if (time < 1) {return " \(time*1000) ms"}
    else {return " \(time) s"}
    }
}	
// start timer
var timer = RunningTimer.init()


print("Problem 3:\nWhat is the largest prime factor of 600851475143 ")

var given = 600851475143
var givensqrt = Double(given).squareRoot()
var factors : Array = [1]
// Find factors
// until we have found all the factors
// once we have found all, given will have been reduced to 1
while given != 1 {
	if given % 2 == 0 {
		factors.append(2)
	}
	// label the for loop so we can break out of it
	// using number theory we can derive that the prime factors can be
	// found this way, as we include 2 and the prime factor of a larger 
	// factor will be found first
	factor_loop: for i in 3...Int(givensqrt) {
		if given % i == 0 {
			factors.append(i)
			// debugging
			print("\(i), \(given)")
			given /= i
			// swifts control break uses loop labeling,
			// otherwise i would break out of if
			break factor_loop
		}
	}
}
print(factors)
// Find max prime factor
var max = factors[0]
for i in 0..<factors.count {
	if( factors[i] > max ){ max = factors[i] }
}
print("The largest prime factor is: \(max)")
print("Runtime is nanosecs : \(timer)")
