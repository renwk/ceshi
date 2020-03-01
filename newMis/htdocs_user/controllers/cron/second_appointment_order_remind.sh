#!/bin/bash
cur_dir=`dirname $0`
phpfile="$cur_dir/../../index.php"
logfile="/crontabLog/appointment_order_remind.error"
interval=0
time1=`date "+%s"`
while [ $interval -lt 60 ]
do
        time2=`date "+%s"`
        interval2=`expr $time2 - $time1`
        if [ $interval2 -ne $interval ]
        then
                interval=$interval2
                /usr/bin/php -f $phpfile  cron cron_appointmentOrderRemind >>$logfile
        fi
done

###########################################################################
##                           ALERT!!!!!!!!!!!!                         ####
## SVN update file will be DOS format, DOS format CAN NOT run at linux ####
## use vi open file, :set ff?  , you can get file format               ####
## use vi, :%s/^m//g                                                   ####
## or dos2unix filename  (yum install dos2unix)                        ####
###########################################################################