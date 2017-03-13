public class spiral_diagonals {
	public static final int SIZE = 1001;
	public static void main(String[] args) {
		// int[][] spiral = createSpiral(1001);
		// System.out.println(display2DArray(spiral));
		// System.out.println(getDiagonalSum(spiral));

		int sum=0;
		for (int i=1; i<=Math.ceil(SIZE/2.0); i++) {
			sum += getSumOfSpiralCorners(i);
		}
		System.out.println(sum);
	}

	public static int getSumOfSpiralCorners(int x) {
		if (x == 1) {
			return 1;
		}
		return ((int)Math.pow(x+(x-1), 2)) + ((int)Math.pow(x+(x-1), 2) - (2*(x-1))) + ((int)Math.pow(x+(x-1), 2) - (4*(x-1))) + ((int)Math.pow(x+(x-1), 2) - (6*(x-1)));
	}

	/**
	 * Creates a 2D array "spiral" of incrementing numbers
	 * Is the more _fun_ way of doing it, but takes a while
	 * 
	 * @param  size odd int size to make square array
	 * @return 2D int array of diagonal
	 */
	public static int[][] createSpiral(int size) {
		// check to make sure the argument is odd
		if (size % 2 == 0) {
			throw new IllegalArgumentException();
		}

		// declare and intialize square array
		int[][] array = new int[size][size];

		// declare indecies
		int minRow, minCol, maxRow, maxCol;
		// minRow = the row to start on (inclusive)
		// maxRow = the row to end on (inclusive)
		// minCol = the col to start on (inclusive)
		// maxCol = the col to end on (inclusive)
		// start in center
		minRow = minCol = maxRow = maxCol = (int)(size/2);

		// current number
		int num = 1;

		while (num <= size*size) { // until spiral is full
			if (num == 1) {
				array[minRow][minCol] = num++;
				minRow--;
				minCol--;
				maxRow++;
				maxCol++;
			} else {
				// start in maxCol
				// [1]
				// [2] <= first
				// [3] <= second
				// [4] <= third
				for (int row=minRow+1; row<=maxRow; row++) {
					array[row][maxCol] = num++;
				}

				// now in maxRow
				// [3, 2, x]
				// #2, #1,done already
				for (int col=maxCol-1; col>=minCol; col--) {
					array[maxRow][col] = num++;
				}

				// now in minCol
				// [3] <= third
				// [2] <= second
				// [1] <= first
				// [x] <= done
				for (int row=maxRow-1; row>=minRow; row--) {
					array[row][minCol] = num++;
				}
				
				// now in minRow
				//   [x, 1, 2]
				// done,#1,#2
				for (int col=minCol+1; col<=maxCol; col++) {
					array[minRow][col] = num++;
				}

				minRow--;
				minCol--;
				maxRow++;
				maxCol++;
			}
		}

		// return
		return array;
	}

	public static String display2DArray(int[][] array) {
		String str = "";
		for (int row=0; row<array.length; row++) {
			for (int col=0; col<array[row].length; col++) {
				if (array[row][col] >= 10){
					str += array[row][col]+" ";
				} else {
					str += array[row][col]+"  ";
				}
			}
			str += "\n";
		}
		return str;
	}

	public static int getDiagonalSum(int[][] array) {
		// check to make sure the argument is valid
		if (array.length != array[0].length) {
			throw new IllegalArgumentException();
		}

		int sum = -1; // accounting for duplicate 1 in middle

		// major
		for (int rowcol=0; rowcol<array.length; rowcol++) {
			sum += array[rowcol][rowcol];
		}

		// minor
		for (int row=0; row<array.length; row++) {
			sum += array[row][array.length-1-row];
		}

		return sum;
	}
}
