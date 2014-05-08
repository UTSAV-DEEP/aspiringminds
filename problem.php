<head>
	<title>Question</title>
</head>
<body>
	<?php
		$filename = "problem.txt";
		$file = fopen( $filename, "r" );
		if( $file == false )
		{
			echo ( "Error in opening file" );
			exit();
		}
		$filesize = filesize( $filename );
		$filetext = fread( $file, $filesize );
		fclose( $file );
		print ( nl2br(htmlspecialchars($filetext) ));
	?>
</body>
</html>

