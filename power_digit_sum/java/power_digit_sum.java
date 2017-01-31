import java.math.BigInteger;

public class power_digit_sum {
	public static void main(String[] args) {
		BigInteger powered = new BigInteger("2");
		powered = powered.pow(1000);
		int sum=0;
		for (int i=0; i<powered.toString().length(); i++) {
			sum += Integer.parseInt(powered.toString().substring(i, i+1));
		}
		System.out.println(sum);
	}
}