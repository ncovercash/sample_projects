function a_plus_b() {
	echo $(bc <<< "$1 + $2")
}


