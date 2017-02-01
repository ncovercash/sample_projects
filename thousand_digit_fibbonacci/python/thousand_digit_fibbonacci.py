#!/usr/bin/python

a=1L
b=1L
i=3L

while len(str(b)) < 1000: # I know, i know
	tmp=a
	a=b
	b=a+tmp
	if len(str(b)) >= 1000:
		print i
	i+=1
