public class mults_of_3_and_5 {
	public static void main(String[] args) {
		System.out.println(get3Sum(Integer.parseInt(args[0]))+get5Sum(Integer.parseInt(args[0])));
	}

	private static int get3Sum(int max) {
		int total=0;
		for (int i=0; i<max; i+=3) {
			total += i;
		}
		return total;
	}

	private static int get5Sum(int max) {
		int total=0;
		for (int i=0; i<max; i+=5) {
			if (i % 3 != 0) {
				total += i;
			}
		}
		return total;
	}
}