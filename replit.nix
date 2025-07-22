{ pkgs }:

{
  deps = [
    pkgs.php80
    pkgs.php80Packages.pdo_mysql
  ];
}
