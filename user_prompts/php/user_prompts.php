<?

$name = readline("Name: ");
$age = readline("Age: ");
$uname = readline("Reddit Username: ");

if (strpos($uname, "u/") === 0) {
	$uname = "/".$uname;
}
if (strpos($uname, "/u/") === false) {
	$uname = "/u/".$uname;
}

echo "Your name is {$name}, you are {$age} years old, and your username is {$uname}\n";
