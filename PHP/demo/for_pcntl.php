
for ( $i = 1; $i <= 3; $i++ ) {
  $pid = pcntl_fork();
  if ( 0 == $pid ) {
    echo "子进程\n";exit;
  }
}
