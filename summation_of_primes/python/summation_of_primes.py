import math

max = 2000000

primes = [2]

for i in xrange(3,max,2):
	prime = True
	limit = math.ceil(math.sqrt(i)) # tip from SO
	for j in xrange(3, int(limit)+1, 2):
		if prime:
			if i % j == 0:
				prime = False
	if prime:
		primes.append(i)

sum = 0
for prime in primes:
	sum += prime;

print sum;
