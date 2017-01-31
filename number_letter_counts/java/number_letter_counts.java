public class number_letter_counts {
	public static void main(String[] args) {
		int total=0;
		for (int i=1; i<=1000; i++) {
			System.out.println(getWordVal(i));
			String word=getWordVal(i);
			for (int j=0; j<word.length(); j++) {
				if (Character.isLetter(word.charAt(j))) {
					total++;
				}
			}
		}
		System.out.println(total);
	}

	public static String getWordVal(int num) {
		String str="";
		if (num == 1000) {
			return "One Thousand";
		}
		if (num >= 100) {
			str += getDigitVal((int)Math.floor(num/100))+" hundred ";
			num -= (int)Math.floor(num/100)*100;
		}
		if (str.length() > 0 && num > 0) {
			str += "and ";
		}
		if (num / 10 >= 1) {
			if (num < 20 && num >= 10) {
				switch (num) {
					case 10:
						str += "Ten";
						break;
					case 11:
						str += "Eleven";
						break;
					case 12:
						str += "Twelve";
						break;
					case 13:
						str += "Thirteen";
						break;
					case 14:
						str += "Fourteen";
						break;
					case 15:
						str += "Fifteen";
						break;
					case 16:
						str += "Sixteen";
						break;
					case 17:
						str += "Seventeen";
						break;
					case 18:
						str += "Eighteen";
						break;
					case 19:
						str += "Nineteen";
						break;
				}
				num -= num;
			} else {
				str += getTensDigitVal((int)Math.floor(num/10));
				num -= (int)Math.floor(num/10)*10;
			}
		}
		if (num > 0) {
			str += getDigitVal(num);
		}
		return str;
	}

	public static String getDigitVal(int in) {
		switch (in) {
			case 1:
				return "One";
			case 2:
				return "Two";
			case 3:
				return "Three";
			case 4:
				return "Four";
			case 5:
				return "Five";
			case 6:
				return "Six";
			case 7:
				return "Seven";
			case 8:
				return "Eight";
			case 9:
				return "Nine";
			default:
				return "INVALID";
		}
	}

	public static String getTensDigitVal(int num) {
		switch (num) {
			case 2:
				return "Twenty-";
			case 3:
				return "Thirty-";
			case 4:
				return "Forty-";
			case 5:
				return "Fifty-";
			case 6:
				return "Sixty-";
			case 7:
				return "Seventy-";
			case 8:
				return "Eighty-";
			case 9:
				return "Ninety-";
			default:
				return "INVALID";
		}
	}
}