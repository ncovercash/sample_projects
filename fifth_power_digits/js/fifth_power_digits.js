// intended to be ran in a command line environment!!

qualified = [];

for (var i = 2; i < 1000000; i++) {
	sum = 0;
	num = i
	sum += Math.floor(num/100000)**5;
	num -= Math.floor(num/100000)*100000;
	sum += Math.floor(num/10000)**5;
	num -= Math.floor(num/10000)*10000;
	sum += Math.floor(num/1000)**5;
	num -= Math.floor(num/1000)*1000;
	sum += Math.floor(num/100)**5;
	num -= Math.floor(num/100)*100;
	sum += Math.floor(num/10)**5;
	num -= Math.floor(num/10)*10;
	sum += num**5;
	if (sum == i) {
		debug(i);
		qualified.push(i);
	}
}

debug(qualified);

debug(qualified.reduce(function(a,b) {
	return a+b;
}))
