<?php
# $Id$
# Unit test: PHPlot DrawText function - GD, 0deg, multiple lines
# This is a parameterized test. See the script named at the bottom for details.
$tp = array(
  'textangle' => 0,   # Text angle. GD fonts only allow 0 and 90.
  'nlines' => 5,      # Number of lines of text
  );
require 'drawtext.php';
