import java.util.*;

public class non_abundant_sums {
	static ArrayList<Integer> abundant = new ArrayList<Integer>();

	public static void main(String[] args) {
		for (int i=12; i<=28123; i++) {
			if (isAbundant(i)) {
				abundant.add(i);
			}
		}

		int total=0;

		for (int i=1; i<=28123; i++) {
			if (!sumOf2Abundant(i)) {
				total += i;
			}
		}

		System.out.println(total);
	}

	public static boolean sumOf2Abundant(int in) {
		for (int i=0; i<abundant.size() && abundant.get(i) < in; i++) {
			if (isAbundant(in-abundant.get(i).intValue())) {
				return true;
			}
		}
		return false;
	}

	public static ArrayList<Integer> getFactors(int in) {
		ArrayList<Integer> factors = new ArrayList<Integer>();
		factors.add(1);
		int limit = (int)Math.ceil(Math.sqrt(in));
		for (int i=2; i<=limit; i++) {
			if (in % i == 0) {
				factors.add(new Integer(i));
				factors.add(new Integer(in/i));
			}
		}
		Set list = new HashSet(factors);
		factors = new ArrayList<Integer>(list);
		return factors;
	}

	public static boolean isAbundant(int in) {
		if (in <= 0) {
			return false;
		}
		int total=0;

		ArrayList<Integer> factors = getFactors(in);

		for (Integer val : factors) {
			total += val.intValue();
		}
		return total > in;
	}
}