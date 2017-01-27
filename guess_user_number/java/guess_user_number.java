import java.util.Scanner;

public class guess_user_number {
	public static void main(String[] args) {
		Scanner scan = new Scanner(System.in);

		int min=1,max=101;
		boolean found=false;

		while (!found) {
			int mid = (max-min)/2+min;
			System.out.print(mid + "? >>> ");
			String response = scan.nextLine().toUpperCase();
			if (response.equals("Y")) {
				System.out.println("Found it: "+mid);
				found = true;
			} else if (response.equals("L")) {
				min = mid;
			} else if (response.equals("H")) {
				max = mid;
			}
		}
	}
}