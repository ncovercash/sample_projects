import itertools

def permute(input):
	if len(input) == 2:
		return [input, input[::-1]]

	permutations = []
	for i in range(0,len(input)):
		permutations.append(map(lambda x: input[i]+x, permute(input[:i]+input[i+1:])))
	return sum(permutations, [])

def prepend(str1, str2):
	return str1+str2

print permute("0123456789")[999999]
