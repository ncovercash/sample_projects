import java.util.*;

public class highly_divisible_triangular {
	public static void main(String[] args) {
		int curVal=0,curAdd=0;
		boolean found=false;

		while (curVal >= 0 && !found) { //overflow protection
			curAdd++;
			curVal+=curAdd;
			System.out.println(curVal+" "+getFactors(curVal));
			if (getFactors(curVal) >= 500) {
				found = true;
			}
		}

		System.out.println(curVal);
	}

	public static int getFactors(int in) {
		ArrayList<Integer> factors = new ArrayList<Integer>();
		int limit = (int)Math.ceil(Math.sqrt(in));
		for (int i=1; i<=limit; i++) {
			if (in % i == 0) {
				factors.add(new Integer(i));
				factors.add(new Integer(in/i));
			}
		}
		Set list = new HashSet(factors);
		factors = new ArrayList<Integer>(list);
		return factors.size();
	}
}
