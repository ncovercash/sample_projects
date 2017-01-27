primeNums = 0
latestPrime=0
current=2

def isPrime(a):
	for x in xrange(2,a):
		if a % x == 0:
			return False
	return True

while primeNums != 10001:
	if isPrime(current):
		primeNums+=1
		latestPrime = current
	current += 1

print latestPrime