<?php

?>
cd /www/wwwroot
wget https://dlcdn.apache.org/zookeeper/zookeeper-3.7.0/apache-zookeeper-3.7.0-bin.tar.gz
tar zxf apache-zookeeper-3.7.0-bin.tar.gz
mv apache-zookeeper-3.7.0-bin /usr/local


cd /usr/local/apache-zookeeper-3.7.0-bin/ && mkdir data
echo 0 > data/myid
echo 1 > data/myid
echo 2 > data/myid
echo 3 > data/myid

cp /usr/local/apache-zookeeper-3.7.0-bin/conf/zoo_sample.cfg /usr/local/apache-zookeeper-3.7.0-bin/conf/zoo.cfg
vim /usr/local/apache-zookeeper-3.7.0-bin/conf/zoo.cfg

cd /usr/local/apache-zookeeper-3.7.0-bin && bin/zkServer.sh start
cd /usr/local/apache-zookeeper-3.7.0-bin && bin/zkCli.sh
#配置
server.1=192.168.10.91:2888:3888
server.2=192.168.10.92:2888:3888
server.3=192.168.10.93:2888:3888

cd /www/wwwroot/mycat/conf
cp schema.xml server.xml rule.xml sequence_db_conf.properties zkconf/


yum install haproxy -y

cd /etc/haproxy/

yum -y install xinetd







TYPE="Ethernet"
PROXY_METHOD="none"
BROWSER_ONLY="no"
BOOTPROTO="static"
DEFROUTE="yes"
IPV4_FAILURE_FATAL="no"
IPV6INIT="yes"
IPV6_AUTOCONF="yes"
IPV6_DEFROUTE="yes"
IPV6_FAILURE_FATAL="no"
IPV6_ADDR_GEN_MODE="stable-privacy"
NAME="enp0s3"
UUID="601927d6-d3f2-4e11-adfe-b4246a792ca7"
DEVICE="enp0s3"
ONBOOT="yes"
IPADDR="192.168.10.91"
NETMASK="255.255.255.0"
GATEWAY="192.168.10.1"
