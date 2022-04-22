
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>uploadMultile</title>

<link href="uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<script type="text/javascript" src="jquery.uploadify.v2.1.4.min.js"></script>


</head>
<body>
	<div id="status-message"></div>
	<div id="custom-queue"></div>
	<form action="" method="post" enctype="multipart/form-data">
		<input id="file_upload" name="file_upload" type="file" />
	</form>
</body>


<script type="text/javascript">
    $(document).ready(function() {
      $('#file_upload').uploadify({
        'uploader'  : 'uploadify.swf',
        'script'    : 'testUpl.php',        //'script'    : 'uploadify.php',
        'cancelImg' : 'cancel.png',
       // 'folder' :'upload',
        'multi'          : true,
        'auto'           : true,
        'fileExt'        : '*.jpg;*.gif;*.png',
        'fileDesc'       : 'Image Files (.JPG, .GIF, .PNG)',
        'queueID'        : 'custom-queue',
        'queueSizeLimit' : 15,
        'simUploadLimit' : 15,
        'removeCompleted': false,
        'onSelectOnce'   : function(event,data) {
            $('#status-message').text(data.filesSelected + ' files have been added to the queue.');
          },
        'onAllComplete'  : function(event,data) {
            $('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');
          }
      });				});
    </script>
</html>
<?php

