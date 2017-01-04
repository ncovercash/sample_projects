import objectdraw.*;
import java.awt.Color;
import java.util.Random;

public class puzzle_15 extends WindowController {
	// set in stone
	final private int ROWS = 4;
	final private int COLS = 4;
	private int colWidth, rowWidth;

	final private Color grey=new Color(0xeeeeee), white=new Color(0xffffff);

	private FilledRect[][] boxes = new FilledRect[ROWS][COLS];
	private FramedRect[][] boxFrames = new FramedRect[ROWS][COLS];
	private Text[][] boxText = new Text[ROWS][COLS];
	private int[][] boxVals = new int[ROWS][COLS];

	private int[] blank = new int[2];

	public static void main(String[] args) {
		// objectdraw init
		new puzzle_15().startController(512,512+44); // 44 is correction
	}

	public void begin() {
		// have to use this method bc objectdraw
		colWidth = canvas.getWidth()/COLS;
		rowWidth = canvas.getHeight()/ROWS;
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
				boxes[row][col] = new FilledRect(colWidth*col, rowWidth*row, colWidth, rowWidth, canvas);
				boxes[row][col].setColor(grey);

				// make grid
				boxFrames[row][col] = new FramedRect(colWidth*col, rowWidth*row, colWidth, rowWidth, canvas);

				// make nums
				boxText[row][col] = new Text(boxVals[row][col], (colWidth*col)+(colWidth/2), (rowWidth*row)+(rowWidth/2), canvas);
				boxText[row][col].setFontSize(colWidth/2);
				boxText[row][col].move(-boxText[row][col].getWidth()/2, -boxText[row][col].getHeight()/2);

				// 0 is our empty spot
				if (boxVals[row][col] == 0) {
					boxText[row][col].setText("");
					blank[0] = row;
					blank[1] = col;
					boxes[row][col].setColor(white);
				}
			}
		}
	}

	public void onMouseClick(Location click) {
		if (blank[0] != 0 && boxes[blank[0]-1][blank[1]].contains(click)) { // check N box
			moveWithOffset(-1,0);
		} else if (blank[1] != COLS-1 && boxes[blank[0]][blank[1]+1].contains(click)) { // check E box
			moveWithOffset(0,1);
		} else if (blank[0] != ROWS-1 && boxes[blank[0]+1][blank[1]].contains(click)) { // check S box
			moveWithOffset(1,0);
		} else if (blank[1] != 0 && boxes[blank[0]][blank[1]-1].contains(click)) { // check W box
			moveWithOffset(0,-1);
		}
		if (blank[0] == COLS-1 && blank[1] == ROWS-1) {
			checkWinner();
		}
	}

	public void moveWithOffset(int offsetX, int offsetY) {
		// swap colors
		boxes[blank[0]+offsetX][blank[1]+offsetY].setColor(white);
		boxes[blank[0]][blank[1]].setColor(grey);

		// old blank becomes clicked num
		boxText[blank[0]][blank[1]].setText(boxVals[blank[0]+offsetX][blank[1]+offsetY]);
		boxText[blank[0]][blank[1]].moveTo((colWidth*blank[1])+(colWidth/2), (rowWidth*blank[0])+(rowWidth/2));
		boxText[blank[0]][blank[1]].move(-boxText[blank[0]][blank[1]].getWidth()/2, -boxText[blank[0]][blank[1]].getHeight()/2);
		boxText[blank[0]+offsetX][blank[1]+offsetY].setText("");

		// update vals
		boxVals[blank[0]][blank[1]] = boxVals[blank[0]+offsetX][blank[1]+offsetY];
		boxVals[blank[0]+offsetX][blank[1]+offsetY] = 0;

		// update blank
		blank[0] += offsetX;
		blank[1] += offsetY;
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
