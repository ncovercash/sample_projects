def a_plus_b():
	input = raw_input("Input 2 numbers seperated by spaces: ")
	exploded = input.split()
	return int(exploded[0])+int(exploded[1])

if __name__ == "__main__":
	print a_plus_b()