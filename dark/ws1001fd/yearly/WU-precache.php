<?php
/**
 * Project:   WU GRAPHS
 * Module:    WU-precache.php 
 * Copyright: (C) 2010 Radomir Luza
 * Email: luzar(a-t)post(d-o-t)cz
 * WeatherWeb: http://pocasi.hovnet.cz 
 */
################################################################################
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 3
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>. 
################################################################################
# 
#             WU-PRECACHE INFO -- AUTO WU files caching
#
# This script is automatically called from WUG pages.
# If you have a small number of visitors to your site, 
# you can run this script scheduled using cron every 
# 10.minutes or more (not less). 
# In one request will be processed up to three WU cache files. 
# In one day it is up to  432 WU cached files.
#
# Cron example(): 
# * /15 * * * * lynx -source http://www.mywebsite.com/wxugraphs/precache.php
# 
# Don't have option to start cron job on your server? Then look at the list 
# of oline cron job services: http://www.onlinecronservices.com
# 
################################################################################
# settings
################################################################################

// number of processed files per run
$cronFiles = 1; //Default: 1 ; Min: 0; Max: 3; 

################################################################################
# end settings
################################################################################

include_once('WUG-settings.php');
$cron = true;
include_once('WUG-pre.php');


?>
