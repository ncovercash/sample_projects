#!/usr/bin/python

import random

ROWS = 4
COLS = 4

NUM_SHUFFLES = ROWS**COLS

print "Welcome"
print "To move, enter N, E, S, or W to move in that direction"

def printPuzzle():
	for row in puzzle:
		printme = ""
		for col in row:
			if col == 0:
				printme += "    "
			elif col < 10:
				printme += "[ "+str(col)+"]"
			else:
				printme += "["+str(col)+"]"
		print printme

def move(x, y):
	if (x == -1 and y == 0):
		if blankPos[1] != 0:
			puzzle[blankPos[0]][blankPos[1]] = puzzle[blankPos[0]][blankPos[1]-1]
			puzzle[blankPos[0]][blankPos[1]-1] = 0
			blankPos[1] -= 1
	elif (x == 1 and y == 0):
		if blankPos[1] != 3:
			puzzle[blankPos[0]][blankPos[1]] = puzzle[blankPos[0]][blankPos[1]+1]
			puzzle[blankPos[0]][blankPos[1]+1] = 0
			blankPos[1] += 1
	elif (x == 0 and y == -1):
		if blankPos[0] != 0:
			puzzle[blankPos[0]][blankPos[1]] = puzzle[blankPos[0]-1][blankPos[1]]
			puzzle[blankPos[0]-1][blankPos[1]] = 0
			blankPos[0] -= 1
	elif (x == 0 and y == 1):
		if blankPos[0] != 3:
			puzzle[blankPos[0]][blankPos[1]] = puzzle[blankPos[0]+1][blankPos[1]]
			puzzle[blankPos[0]+1][blankPos[1]] = 0
			blankPos[0] += 1

def check():
	for row in xrange(0,ROWS):
		for col in xrange(0,COLS):
			if puzzle[row][col] != 1+(row*4)+col and puzzle[row][col] != 0:
				return False
	return True

while True:
	puzzle = []

	for i in xrange(0,ROWS):
		puzzle.append([])

	pieces = list(xrange(1,ROWS*COLS))
	pieces.append(0)

	for i in pieces:
		puzzle[int((i-1)/ROWS)].append(i)

	blankPos=[ROWS-1,COLS-1]

	i=0
	while i<1:
		rand = random.randint(0,3)
		if rand == 0:
			if blankPos[1] != 0:
				move(-1,0)
				i += 1
			else:
				i -= 1
		elif rand == 1:
			if blankPos[1] != 3:
				move(1,0)
				i += 1
			else:
				i -= 1
		elif rand == 2:
			if blankPos[0] != 0:
				move(0,-1)
				i += 1
			else:
				i -= 1
		elif rand == 3:
			if blankPos[0] != 3:
				move(0,1)
				i += 1
			else:
				i -= 1

	while True:
		printPuzzle()

		direction = raw_input(">>> ")

		if direction == "N":
			move(0,-1)
		elif direction == "E":
			move(1, 0)
		elif direction == "S":
			move(0,1)
		elif direction == "W":
			move(-1, 0)

		if check():
			printPuzzle()
			print "YOU WIN!!"
			raw_input("Press enter to restart!")
			break;
