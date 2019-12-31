<?php
class sng_CallHistoryViewStream extends SugarView{
	public function display() {
		ob_end_clean();
		$account = BeanFactory::getBean('sng_CallHistory')->retrieve_by_string_fields(array('linkedid'=>$_REQUEST['uuid']));
		if(!empty($account->linkedid) && !empty($account->recording_location)) {
			$uuid = str_replace(".","_",$account->linkedid);
			$file = basename($_REQUEST['file']);
			if(file_exists($account->recording_location."/".$file)) {
				$this->getHTML5File($account->recording_location,$file);
				exit();
			}
		}
		header("HTTP/1.0 404 Not Found");
		exit();
	}

	public function getHTML5File($fpath, $filename, $download=false) {
		$filename = basename($filename);
		//Session write close because Safari slams us with requests
		//asking for 2 bytes before proceeding to then request the full file.
		//As is the case with PHP sessions are locked until the previous session
		//has completed. When the server is slammed multiple requests are
		//blocked, therefore we always close the session before streaming the file
		//http://konrness.com/php5/how-to-prevent-blocking-php-requests/
		session_write_close();
		$filename = $fpath ."/".$filename;
		$format = pathinfo($filename, PATHINFO_EXTENSION);
		if (is_file($filename)){
			switch($format) {
				case "mp3":
					$ct = "audio/mpeg";
				break;
				case "m4a":
					$ct = "audio/mp4";
				break;
				case "wav":
					$ct = "audio/wav";
				break;
				case "oga":
				case "ogg":
					$ct = "audio/ogg";
					$format = "oga";
				break;
				default:
					throw new \Exception("I have no idea was this file is: $filename");
				break;
			}
			header("Content-type: ".$ct); // change mimetype
			if (!$download && isset($_SERVER['HTTP_RANGE'])){ // do it for any device that supports byte-ranges not only iPhone
				$size   = filesize($filename); // File size
				$length = $size;           // Content length
				$start  = 0;               // Start byte
				$end    = $size - 1;       // End byte

				// Now that we've gotten so far without errors we send the accept range header
				/* At the moment we only support single ranges.
				* Multiple ranges requires some more work to ensure it works correctly
				* and comply with the specifications: http://www.w3.org/Protocols/rfc2616/rfc2616-sec19.html#sec19.2
				*
				* Multirange support annouces itself with:
				* header('Accept-Ranges: bytes');
				*
				* Multirange content must be sent with multipart/byteranges mediatype,
				* (mediatype = mimetype)
				* as well as a boundry header to indicate the various chunks of data.
				*/
				header("Accept-Ranges: 0-$length");
				// header('Accept-Ranges: bytes');
				// multipart/byteranges
				// http://www.w3.org/Protocols/rfc2616/rfc2616-sec19.html#sec19.2
				if (isset($_SERVER['HTTP_RANGE'])){
					$c_start = $start;
					$c_end   = $end;

					// Extract the range string
					list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
					// Make sure the client hasn't sent us a multibyte range
					if (strpos($range, ',') !== false){
						header('HTTP/1.1 416 Requested Range Not Satisfiable');
						header("Content-Range: bytes $start-$end/$size");
						exit;
					}
					// If the range starts with an '-' we start from the beginning
					// If not, we forward the file pointer
					// And make sure to get the end byte if specified
					if ($range{0} == '-'){
						// The n-number of the last bytes is requested
						$c_start = $size - substr($range, 1);
					} else {
						$range  = explode('-', $range);
						$c_start = $range[0];
						$c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
					}
					/* Check the range and make sure it's treated according to the specs.
					* http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
					*/
					// End bytes can not be larger than $end.
					$c_end = ($c_end > $end) ? $end : $c_end;
					// Validate the requested range and return an error if it's not correct.
					if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size){
						header('HTTP/1.1 416 Requested Range Not Satisfiable');
						header("Content-Range: bytes $start-$end/$size");
						// (?) Echo some info to the client?
						exit;
					}

					$start  = $c_start;
					$end    = $c_end;
					$length = $end - $start + 1; // Calculate new content length
					header('HTTP/1.1 206 Partial Content');
				}

				// Notify the client the byte range we'll be outputting
				header("Content-Range: bytes $start-$end/$size");
				header("Content-Length: $length");
				header('Content-Disposition: attachment;filename="' . basename($filename).'"');

				$buffer = 1024 * 8;
				ob_end_clean();
				ob_start();
				set_time_limit(0);
				while(true) {
					$fp = fopen($filename, "rb");
					fseek($fp, $start);
					if(!feof($fp) && ($p = ftell($fp)) <= $end) {
						if ($p + $buffer > $end) {
							$buffer = $end - $p + 1;
						}
						$contents = fread($fp, $buffer);
						$start = $start + $buffer;
						fclose($fp);
						echo $contents;
						ob_flush();
						flush();
					} else {
						fclose($fp);
						break;
					}
				}
			} else {
				header("Content-length: " . filesize($filename));
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
				header('Content-Disposition: attachment;filename="' . basename($filename).'"');
				set_time_limit(0);
				$fp = fopen($filename, "rb");
				fpassthru($fp);
				ob_flush();
				flush();
				fclose($fp);
			}
		}
	}
}
