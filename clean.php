<?php
#========================================================================
// From http://www.jonasjohn.de/snippets/php/delete-temporary-files.htm
// Define the folder to clean
// (keep trailing slashes)
$captchaFolder  = 'tmp/';

//================================================
// Clean files
// Filetypes to check (you can also use *.*)
$fileTypes      = 'interMonitoring*';

// Here you can define after how many
// seconds the files should get deleted
$expire_time    = 30 * 24 * 60 * 60;

// Find all files of the given file type
foreach (glob($captchaFolder . $fileTypes) as $Filename) {

    // Read file modification time
    $FileModificationTime = filemtime($Filename);

    // Calculate file age in seconds
    $FileAge = time() - $FileModificationTime;

    #print "The file $Filename is $FileAge <BR>";
    #print time()." $FileModificationTime <BR>";
    #print "###############<BR>";

    // Is the file older than the given time span?
    if ($FileAge > $expire_time) {

        // Now do something with the olders files...
        print "Note: file destroyed with age of $FileAge<BR>\n";
        // For example deleting files:
        unlink($Filename);

	# Secure ?
	exec("rm -rf $Filename");
    }
}

//================================================
// Clean sess files
// Filetypes to check (you can also use *.*)
$fileTypes      = 'sess*';

// Here you can define after how many
// seconds the files should get deleted
$expire_time    = 30 * 24 * 60 * 60;

// Find all files of the given file type
foreach (glob($captchaFolder . $fileTypes) as $Filename) {

    // Read file modification time
    $FileModificationTime = filemtime($Filename);

    // Calculate file age in seconds
    $FileAge = time() - $FileModificationTime;

    #print "The file $Filename is $FileAge <BR>";

    // Is the file older than the given time span?
    if ($FileAge > $expire_time) {

        // Now do something with the olders files...
        print "Note: session destroyed with age of $FileAge<BR>";
        // For example deleting files:
        session_destroy();
        unlink($Filename);
    }
}
#========================================================================
?>
