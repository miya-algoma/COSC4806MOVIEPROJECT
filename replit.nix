{ pkgs }: {
  deps = [
    pkgs.php82
    pkgs.php82Extensions.pdo_mysql
    pkgs.mysql
  ];
}
