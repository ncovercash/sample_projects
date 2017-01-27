import java.util.Scanner;

public class beer_bottles {
	public static void main(String[] args) {
		for (int i=99; i>0; i--) {
			System.out.print(i+" bottles of beer on the wall\n"+i+" bottles of beer\nTake one down, pass it around\n"+(i-1)+" bottles of beer on the wall\r\n\r\n");
		}
	}
}