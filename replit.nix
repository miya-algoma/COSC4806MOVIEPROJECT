{ pkgs }: {
	deps = [
		pkgs.php82
		pkgs.php82Packages.pdo_mysql
		pkgs.mysql
	];
}
