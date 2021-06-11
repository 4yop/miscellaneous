<?php
$pid = pcntl_fork();

	if ( 0 == $pid ) {
		echo "I am in child process\n";
	}
	else if ( $pid > 0 ) 
	{
		echo "I am in father process";
	}else
	{
		throw new Exception("err");
	}

