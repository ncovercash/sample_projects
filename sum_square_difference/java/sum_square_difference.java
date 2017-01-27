public class sum_square_difference {
	public static void main(String[] args) {
		System.out.println(squaresSum(100) - sumSquares(100));
	}

	public static int sumSquares(int max) {
		int total=0;
		for (int i=1; i<=max; i++) {
			total += Math.pow(i,2);
		}
		return total;
	}

	public static int squaresSum(int max) {
		int total=0;
		for (int i=1; i<=max; i++) {
			total += i;
		}
		return (int)Math.pow(total, 2);
	}
}
