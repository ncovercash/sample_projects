#!/usr/local/bin/python
divisible = False
testing = 0
while not divisible:
	testing += 20
	divisible = True
	print testing
	for x in xrange(1,21):
		if divisible and testing % x != 0:
			divisible = False

print testing
