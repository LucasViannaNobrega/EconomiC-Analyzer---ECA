<?php
# $Id$
# PHPlot test: Date/time range on X axis
#            H, M, S, mo, da, yr
$t1 = mktime(0, 0, 0, 3, 1, 2012);
$t2 = $t1 + 14 * 60 * 60 * 24; // 14 days
# This is a parameterized test. See the script named at the bottom for details.
$tp = array(
  'xmin' => $t1,               # Lowest X data value
  'xmax' => $t2,               # Highest X data value
  );
require 'range-datex.php';
