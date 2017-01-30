public class collatz_sequence {
	public static void main(String[] args) {
		long[] max = {0,0};

		for (long i=1; i<1000000; i++) {
			long current = i;
			long stepCount = 1;
			while (current != 1) {
				stepCount++;
				if (current % 2 == 0) {
					current /= 2;
				} else {
					current *= 3;
					current++;
				}
			}

			if (stepCount > max[0]) {
				max[0] = stepCount;
				max[1] = i;
			}
		}
		System.out.println(max[1] + " with " + max[0] + " steps");
	}
}