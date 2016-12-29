import objectdraw.*;
import java.awt.Color;
import java.util.Random;

public class puzzle_15 extends WindowController {
	// set in stone
	final private int ROWS = 4;
	final private int COLS = 4;

	FilledRect[][] boxes = new FilledRect[ROWS][COLS];
	FramedRect[][] boxFrames = new FramedRect[ROWS][COLS];
	Text[][] boxText = new Text[ROWS][COLS];
	int[][] boxVals = new int[ROWS][COLS];

	int[] blankLoc = new int[2];

	public static void main(String[] args) {
		// objectdraw init
		new puzzle_15().startController(512,512+44); // 44 is for correction from menu, want squares
	}

	public void begin() {
		// have to use this method bc objectdraw
		shuffleVals();
		initBoxes();
	}

	public void shuffleVals() {
		// create 1D array
		int[] tmpVals = new int[ROWS*COLS];
		for (int i=0; i<tmpVals.length; i++) {
			tmpVals[i] = i;
		}

		// shuffle
		Random rnd = new Random();
		for (int i = tmpVals.length - 1; i > 0; i--) {
			int index = rnd.nextInt(i + 1);
			// Simple swap
			int tmp = tmpVals[index];
			tmpVals[index] = tmpVals[i];
			tmpVals[i] = tmp;
		}

		// apply
		for (int i=0; i<tmpVals.length; i++) {
			boxVals[(int)i/ROWS][i%COLS] = tmpVals[i];
		}
	}

	public void initBoxes() {
		for (int row=0; row<ROWS; row++) {
			for (int col=0; col<COLS; col++) {
				// make BG
				boxes[row][col] = new FilledRect(canvas.getWidth()/COLS*col, canvas.getHeight()/ROWS*row, canvas.getWidth()/COLS, canvas.getHeight()/ROWS, canvas);
				boxes[row][col].setColor(new Color(0xeeeeee));

				// make grid
				boxFrames[row][col] = new FramedRect(canvas.getWidth()/COLS*col, canvas.getHeight()/ROWS*row, canvas.getWidth()/COLS, canvas.getHeight()/ROWS, canvas);

				// make nums
				boxText[row][col] = new Text(boxVals[row][col], (canvas.getWidth()/COLS*col)+(canvas.getWidth()/COLS/2), (canvas.getHeight()/ROWS*row)+(canvas.getHeight()/ROWS/2), canvas);
				boxText[row][col].setFontSize(canvas.getWidth()/COLS/2);
				boxText[row][col].move(-boxText[row][col].getWidth()/2, -boxText[row][col].getHeight()/2);

				// 0 is our empty spot
				if (boxVals[row][col] == 0) {
					boxText[row][col].setText("");
					blankLoc[0] = row;
					blankLoc[1] = col;
					boxes[row][col].setColor(new Color(0xffffff));
				}
			}
		}
	}

	public void onMouseClick(Location click) {
		if (blankLoc[0] != 0 && boxes[blankLoc[0]-1][blankLoc[1]].contains(click)) { // check N box
			// swap colors
			boxes[blankLoc[0]-1][blankLoc[1]].setColor(new Color(0xffffff));
			boxes[blankLoc[0]][blankLoc[1]].setColor(new Color(0xeeeeee));

			// old blank becomes clicked num
			boxText[blankLoc[0]][blankLoc[1]].setText(boxVals[blankLoc[0]-1][blankLoc[1]]);
			boxText[blankLoc[0]][blankLoc[1]].moveTo((canvas.getWidth()/COLS*blankLoc[1])+(canvas.getWidth()/COLS/2), (canvas.getHeight()/ROWS*blankLoc[0])+(canvas.getHeight()/ROWS/2));
			boxText[blankLoc[0]][blankLoc[1]].move(-boxText[blankLoc[0]][blankLoc[1]].getWidth()/2, -boxText[blankLoc[0]][blankLoc[1]].getHeight()/2);
			boxText[blankLoc[0]-1][blankLoc[1]].setText("");

			// update vals
			boxVals[blankLoc[0]][blankLoc[1]] = boxVals[blankLoc[0]-1][blankLoc[1]];
			boxVals[blankLoc[0]-1][blankLoc[1]] = 0;

			// update blankLoc
			blankLoc[0] -= 1;
		} else if (blankLoc[1] != COLS-1 && boxes[blankLoc[0]][blankLoc[1]+1].contains(click)) { // check E box
			// swap colors
			boxes[blankLoc[0]][blankLoc[1]+1].setColor(new Color(0xffffff));
			boxes[blankLoc[0]][blankLoc[1]].setColor(new Color(0xeeeeee));

			// old blank becomes clicked num
			boxText[blankLoc[0]][blankLoc[1]].setText(boxVals[blankLoc[0]][blankLoc[1]+1]);
			boxText[blankLoc[0]][blankLoc[1]].moveTo((canvas.getWidth()/COLS*blankLoc[1])+(canvas.getWidth()/COLS/2), (canvas.getHeight()/ROWS*blankLoc[0])+(canvas.getHeight()/ROWS/2));
			boxText[blankLoc[0]][blankLoc[1]].move(-boxText[blankLoc[0]][blankLoc[1]].getWidth()/2, -boxText[blankLoc[0]][blankLoc[1]].getHeight()/2);
			boxText[blankLoc[0]][blankLoc[1]+1].setText("");

			// update vals
			boxVals[blankLoc[0]][blankLoc[1]] = boxVals[blankLoc[0]][blankLoc[1]+1];
			boxVals[blankLoc[0]][blankLoc[1]+1] = 0;

			// update blankLoc
			blankLoc[1] += 1;
		} else if (blankLoc[0] != ROWS-1 && boxes[blankLoc[0]+1][blankLoc[1]].contains(click)) { // check S box
			// swap colors
			boxes[blankLoc[0]+1][blankLoc[1]].setColor(new Color(0xffffff));
			boxes[blankLoc[0]][blankLoc[1]].setColor(new Color(0xeeeeee));

			// old blank becomes clicked num
			boxText[blankLoc[0]][blankLoc[1]].setText(boxVals[blankLoc[0]+1][blankLoc[1]]);
			boxText[blankLoc[0]][blankLoc[1]].moveTo((canvas.getWidth()/COLS*blankLoc[1])+(canvas.getWidth()/COLS/2), (canvas.getHeight()/ROWS*blankLoc[0])+(canvas.getHeight()/ROWS/2));
			boxText[blankLoc[0]][blankLoc[1]].move(-boxText[blankLoc[0]][blankLoc[1]].getWidth()/2, -boxText[blankLoc[0]][blankLoc[1]].getHeight()/2);
			boxText[blankLoc[0]+1][blankLoc[1]].setText("");

			// update vals
			boxVals[blankLoc[0]][blankLoc[1]] = boxVals[blankLoc[0]+1][blankLoc[1]];
			boxVals[blankLoc[0]+1][blankLoc[1]] = 0;

			// update blankLoc
			blankLoc[0] += 1;
		} else if (blankLoc[1] != 0 && boxes[blankLoc[0]][blankLoc[1]-1].contains(click)) { // check W box
			// swap colors
			boxes[blankLoc[0]][blankLoc[1]-1].setColor(new Color(0xffffff));
			boxes[blankLoc[0]][blankLoc[1]].setColor(new Color(0xeeeeee));

			// old blank becomes clicked num
			boxText[blankLoc[0]][blankLoc[1]].setText(boxVals[blankLoc[0]][blankLoc[1]-1]);
			boxText[blankLoc[0]][blankLoc[1]].moveTo((canvas.getWidth()/COLS*blankLoc[1])+(canvas.getWidth()/COLS/2), (canvas.getHeight()/ROWS*blankLoc[0])+(canvas.getHeight()/ROWS/2));
			boxText[blankLoc[0]][blankLoc[1]].move(-boxText[blankLoc[0]][blankLoc[1]].getWidth()/2, -boxText[blankLoc[0]][blankLoc[1]].getHeight()/2);
			boxText[blankLoc[0]][blankLoc[1]-1].setText("");

			// update vals
			boxVals[blankLoc[0]][blankLoc[1]] = boxVals[blankLoc[0]][blankLoc[1]-1];
			boxVals[blankLoc[0]][blankLoc[1]-1] = 0;

			// update blankLoc
			blankLoc[1] -= 1;
		}
		if (blankLoc[0] == COLS-1 && blankLoc[1] == ROWS-1) {
			checkWinner();
		}
	}

	public void checkWinner() {
		boolean winning=true;
		for (int row=0; row<ROWS; row++) {
			for (int col=0; col<COLS; col++) {
				if (!(boxVals[row][col] == 1+(row*COLS)+col) && col != COLS-1 && row != ROWS-1) {
					winning = false;
				}
			}
		}
		if (winning) {
			shuffleVals();
			initBoxes();
		}
	}
}
