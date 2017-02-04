import java.math.BigDecimal;
import java.math.BigInteger;

public class reciprocal_cycles {
	public static void main(String[] args) {
		int longestRepeatedDenom = 1, longestRepeatedLength = 1;

		for (int i=2; i<1000; i++) {
			BigDecimal numerator=BigDecimal.TEN.pow(i),
			    denominator=new BigDecimal(new BigInteger(new Integer(i).toString()));
			String decimals = numerator.divide(denominator, i*4+2, BigDecimal.ROUND_HALF_UP).toString();
			decimals = decimals.replace(".", "");

			int smallestRepLen = Integer.MAX_VALUE;

			testloop:
			for (int j=0; j<5; j++) { // i < 1000, so all good there
				for (int k=i; k>0; k--) {
					if (decimals.substring(j, j+k).equals(decimals.substring(j+k, j+k+k)) &&
					  decimals.substring(j+k, j+k+k).equals(decimals.substring(j+k+k, j+k+k+k))) {
						if (k < smallestRepLen) {
							smallestRepLen = k;
						}
					}
					if (smallestRepLen <= longestRepeatedLength) {
						break testloop;
					}
				}
			}

			if (smallestRepLen == Integer.MAX_VALUE) {
				smallestRepLen = 1;
			}

			if (smallestRepLen > longestRepeatedLength) {
				longestRepeatedDenom = i;
				longestRepeatedLength = smallestRepLen;
			}
		}
		System.out.println("1/"+longestRepeatedDenom+" has "+longestRepeatedLength+" digits");
	}
}