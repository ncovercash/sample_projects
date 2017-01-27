#!/usr/bin/python

min=1
max=100

print "Think of a number from "+str(min)+" to "+str(max)+".  Then, tell the computer if its guess is correct (Y), lower than the number (L), or higher than the number (H)."

found=False

while not found:
	mid = int((max-min)/2+min)
	response = raw_input(str(mid)+"? >>> ")
	response = response.upper()
	if response == "Y":
		print "found it!!"
		found=True
	elif response == "L":
		min=mid
	elif response == "H":
		max=mid
