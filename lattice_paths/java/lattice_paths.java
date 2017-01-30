import java.math.BigInteger;

public class lattice_paths {
	public static void main(String[] args) {
		System.out.println(permute(40).divide(permute(20)).divide(permute(20)));
	}

	public static BigInteger permute(int num) {
		BigInteger returnMe = BigInteger.ONE;
		for (int i=2; i<= num; i++) {
			returnMe = returnMe.multiply(BigInteger.valueOf(i));
		}
		return returnMe;
	}
}