import java.util.Scanner;

public class user_prompts {
	public static void main(String[] args) {
		Scanner scan = new Scanner(System.in);
		System.out.print("Name: ");
		String name = scan.nextLine();
		System.out.print("Age: ");
		String age = scan.nextLine();
		System.out.print("Reddit Username: ");
		String uname = scan.nextLine();

		if (uname.indexOf("u/") == 0) {
			uname = "/"+uname;
		}
		if (uname.indexOf("/u/") == -1) {
			uname = "/u/"+uname;
		}

		System.out.println("Your name is "+name+", you are "+age+" years old, and your username is "+uname);
	}
}