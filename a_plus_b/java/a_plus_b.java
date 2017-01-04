import java.util.Scanner;

public class a_plus_b {
	public static void main(String[] args) {
		Scanner in = new Scanner(System.in);
		System.out.print(add(in.nextInt(), in.nextInt()));
	}
	
	public static int add(int a, int b) {
		return a + b;
	}
}
