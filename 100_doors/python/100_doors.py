#!/usr/local/bin/python

# toggle a boolean
def toggle(input):
	if bool(input) == True:
		return False
	else:
		return True

# create 100 unopened doors
doors = [False] * 100

#iterate through step counts
i = 1
while i <= 100:
	for x in xrange(i-1, len(doors), i):
		doors[x] = toggle(doors[x])
	i += 1

# print
print "Raw array contents"
print doors

# loop through, find closed (false) indecies
print ""
print "Closed doors:"
s = "[ "
for x in xrange(0,len(doors)):
	if doors[x] == False:
		s += str(x+1)+" "
s += "]" # close it
print s

# loop through, find open (true) indecies
print ""
print "Open doors:"
s = "[ "
for x in xrange(0,len(doors)):
	if doors[x] == True:
		s += str(x+1)+" "
s += "]" # close it
print s
