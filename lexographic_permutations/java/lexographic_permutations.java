import java.util.ArrayList;

public class lexographic_permutations {
	public static void main(String[] args) {
		System.out.println(permute("0123456789").get(999999));
	}

	public static ArrayList<String> permute(String input) {
		ArrayList<String> permutations=new ArrayList<String>();

		if (input.length() == 2) {
			permutations.add(input);
			permutations.add(input.substring(1,2) + input.substring(0,1)); // flip
			return permutations;
		}

		for (int i=0; i<input.length(); i++) {
			ArrayList<String> result = permute(input.substring(0,i)+input.substring(i+1));
			for (int j=0; j<result.size(); j++) {
				result.set(j, input.substring(i, i+1)+result.get(j));
			}
			permutations.addAll(result);
		}
		return permutations;
	}
}
