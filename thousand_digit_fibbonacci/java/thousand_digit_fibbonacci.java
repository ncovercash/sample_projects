import java.math.BigInteger;

public class thousand_digit_fibbonacci {
	public static void main(String[] args) {
		BigInteger a=BigInteger.ONE, b=BigInteger.ONE;
		int i=3; // 1 and 2 set a and b to 1
		while (i < Integer.MAX_VALUE && b.toString().length() < 1000) {
			BigInteger tmp = a;
			a = b;
			b = tmp.add(a);
			if (b.toString().length() >= 1000) {
				System.out.println(i);
			}
			i++;
		}
	}
}