import java.util.*;

public class amicable_numbers {
	public static void main(String[] args) {
		ArrayList<Integer> amicable = new ArrayList<Integer>();

		for (int i=1; i<=10000; i++) {
			ArrayList<Integer> factors = getFactors(i);
			int sum=0;
			for (Integer factor : factors) {
				sum += factor.intValue();
			}
			if (sum != i) {
				ArrayList<Integer> factors2 = getFactors(sum);
				int sum2 = 0;
				for (Integer factor : factors2) {
					sum2 += factor.intValue();
				}
				if (sum2 == i) {
					amicable.add(new Integer(i));
				}
			}
		}

		int total=0;
		for (Integer num : amicable) {
			total += num.intValue();
		}

		System.out.println(total);
	}

	public static ArrayList<Integer> getFactors(int in) {
		ArrayList<Integer> factors = new ArrayList<Integer>();
		factors.add(new Integer(1));
		int limit = (int)Math.ceil(Math.sqrt(in));
		for (int i=2; i<=limit; i++) {
			if (in % i == 0) {
				factors.add(new Integer(i));
				factors.add(new Integer(in/i));
			}
		}

		//uniq
		Set list = new HashSet(factors);
		factors = new ArrayList<Integer>(list);
		return factors;
	}
}