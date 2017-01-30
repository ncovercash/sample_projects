public class special_pythagorean_triplet {
	public static void main(String[] args) {
		int goalSum=1000;
		for (int a=1; a<goalSum/3; a++) {
			for (int b=a+1; b<goalSum/2; b++) {
				int c=goalSum-a-b;
				if (c>0 && ((a*a)+(b*b)) == (c*c)) {
					if (a+b+c==goalSum) {
						System.out.println("a="+a+" b="+b+" c="+c+" product="+(a*b*c));
					}
				}
			}
		}
	}
}
