largestPalindrome=0;

function isPalindrome(a) {
	a=a+""; // toString
	switch (a.length) {
		case 5:
			return a[0] == a[4] && a[1] == a[3];
			break;
		case 6:
			return a[0] == a[5] && a[1] == a[4] && a[2] == a[3];
			break;
	}
}

for (var a = 100; a < 1000; a++) {
	for (var b = 100; b < 1000; b++) {
		if (isPalindrome(a*b)) {
			if (largestPalindrome<(a*b)) {
				largestPalindrome = a*b;
			}
		}
	}
}

debug(largestPalindrome);
