#!/usr/local/bin/python

for beer in xrange(99, 0, -1):
	print "%s bottles of beer on the wall" % str(beer)
	print "%s bottles of beer" % str(beer)
	print "Take one down, pass it around"
	print "%s bottles of beer on the wall" % str(beer-1)
	print ""
