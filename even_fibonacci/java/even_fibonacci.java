public class even_fibonacci {
	public static void main(String[] args) {
		int sum=0;
		int a=0,b=1;
		while (a+b<Integer.parseInt(args[0])) {
			if ((a+b)%2 == 0) {
				sum += a+b;
			}
			int tmp=a;
			a=b;
			b=a+tmp;
		}
		System.out.println(sum);
	}
}