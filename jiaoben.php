<?php

//jdk-8u321-linux-x64.tar.gz 是java jdk 包
$cmds = [
    "mkdir /usr/local/java/",
    "tar -zxvf jdk-8u321-linux-x64.tar.gz -C /usr/local/java/",
    'echo "export JAVA_HOME=/usr/local/java/jdk1.8.0_321" >> /etc/profile',
    'echo "export JRE_HOME=${JAVA_HOME}/jre" >> /etc/profile',
    'echo "export CLASSPATH=.:${JAVA_HOME}/lib:${JRE_HOME}/lib" >> /etc/profile',
    'echo "export PATH=${JAVA_HOME}/bin:$PATH" >> /etc/profile',
    "source /etc/profile",
    "ln -s /usr/local/java/jdk1.8.0_321/bin/java /usr/bin/java",
    "java -version",
];

foreach ($cmds as $cmd)
{
    exec($cmd,$output);
    var_dump($output);
}


