import java.util.Arrays;

public class doors {
	public static void main(String[] args) {
		// create arr
		boolean[] doors = new boolean[100];
		// fill it
		Arrays.fill(doors, false);

		// start iterating for each step
		int step=1;
		while (step <= 100) {
			for (int i = step-1; i < doors.length; i += step) {
				doors[i] = toggle(doors[i]);
			}
			step++;
		}

		// Print raw contents
		System.out.print("Raw contents:\r\n[ ");
		for (boolean door : doors) {
			if (door) {
				System.out.print("Open ");
			} else {
				System.out.print("Closed ");
			}
		}
		System.out.print("]\r\n\r\n"); // Close it off

		// closed doors
		System.out.print("Closed:\r\n[ ");
		for (int i=0; i < doors.length; i++) {
			if (!doors[i]) {
				System.out.print((i+1)+" ");
			}
		}
		System.out.print("]\r\n\r\n"); // Close it off

		// open doors
		System.out.print("Open:\r\n[ ");
		for (int i=0; i < doors.length; i++) {
			if (doors[i]) {
				System.out.print((i+1)+" ");
			}
		}
		System.out.print("]\r\n\r\n"); // Close it off
	}

	public static boolean toggle(boolean item) {
		if (item) {
			return false;
		} else {
			return true;
		}
	}
}
