var totalDays = 0, totalSundays = 0;

for (var year = 1900; year <= 2000; year++) {
	for (var month = 1; month <= 12; month++) {
		if (totalDays % 7 == 6 && year >= 1901) {
			totalSundays++;
		}
		switch (month) {
			case 4:
			case 6:
			case 9:
			case 11:
				totalDays += 30;
				break;
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				totalDays += 31;
				break;
			case 2:
				if ((year % 4 == 0 && year % 100 != 0) ^ year % 400 == 0) {
					totalDays += 29;
				} else {
					totalDays += 28;
				}
				break;
		}
	}
}

debug(totalSundays);
