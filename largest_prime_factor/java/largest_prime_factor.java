import java.util.ArrayList;

public class largest_prime_factor {
	public static void main(String[] args) {
		System.out.println(getLargestPrime(600851475143L));
	}

	public static long getLargestPrime(long input) {
		long newVal=input;
		ArrayList<Long> primes = new ArrayList<Long>();
		for (long i=2; i<newVal+1; i++) {
			if (newVal % i == 0) {
				newVal /= i;
				primes.add(new Long(i));
				i--;
			}
		}
		long highest = 0;
		for (Long prime : primes) {
			if (prime.longValue() > highest) {
				highest = prime.longValue();
			}
		}
		return highest;
	}
}