import java.math.BigInteger;

public class factorial_sum {
	public static void main(String[] args) {
		String digits = permute(100).toString();
		int total = 0;
		for (int i=0; i<digits.length(); i++) {
			total += Integer.parseInt(digits.substring(i, i+1));
		}
		System.out.println(total);
	}

	public static BigInteger permute(int num) {
		BigInteger returnMe = BigInteger.ONE;
		for (int i=2; i<= num; i++) {
			returnMe = returnMe.multiply(BigInteger.valueOf(i));
		}
		return returnMe;
	}
}
