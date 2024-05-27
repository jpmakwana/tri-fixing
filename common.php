<?php

class Common
{
	function send($message, $number)
	{
		$text = rawurlencode($message);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://sms.smsindori.com/http-api.php?username=Radhey&password=12345&senderid=RADCIN&route=06&number=91" . $number . "&message=" . $text . "&templateid=1207161846618083555",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Cache-Control: no-cache",
				"Postman-Token: d3673e58-5a6d-43eb-c91a-96abcb804985"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		return $response;
	}

	function upload_image($file)
	{
		if (isset($file) && $file['size'] != 0) {
			$allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
			$temp = explode(".", $file["name"]);
			$extension = end($temp);
			if ($file["type"] !== "application/x-msdownload") {
				if (in_array($extension, $allowedExts)) {
					$fileName  = $file["name"];
					$fileSize  = round($file["size"]);
					// BYTES
					//echo $fileSize ;exit;
					$extension = end(explode(".", $fileName));
					$fileName	= 'problem_image_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
					$filePath 	= "images/problem_image/" . $fileName;
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$image = $fileName;
					}
				}
			}
		}
		return $image;
	}

	function upload_multi_image($files)
	{
		$uploaded_images = array();

		// Loop through each file
		foreach ($files['name'] as $key => $name) {
			$file = array(
				'name' => $name,
				'type' => $files['type'][$key],
				'tmp_name' => $files['tmp_name'][$key],
				'error' => $files['error'][$key],
				'size' => $files['size'][$key]
			);

			// Check if file is set and not empty
			if (isset($file) && $file['size'] != 0 && $file['error'] == UPLOAD_ERR_OK) {
				$allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
				$temp = explode(".", $file["name"]);
				$extension = end($temp);

				// Check file type and extension
				if ($file["type"] !== "application/x-msdownload" && in_array($extension, $allowedExts)) {
					// Generate unique filename
					$newFileName = 'problem_image_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
					$filePath = "images/problem_image/" . $newFileName;

					// Move the uploaded file to the desired location
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$uploaded_images[] = $newFileName;
					}
				}
			}
		}

		return $uploaded_images;
	}

	function upload_video($file)
	{
		if (isset($file) && $file['size'] != 0) {

			$allowedExts = array("mov", "mp4", "ogg");
			$temp = explode(".", $file["name"]);

			$extension = end($temp);


			if ($file["type"] !== "application/x-msdownload") {

				if (in_array($extension, $allowedExts)) {



					$fileName  = $file["name"];
					$fileSize  = round($file["size"]); // BYTES
					//echo $fileSize ;exit;
					$extension = end(explode(".", $fileName));

					$fileName	= 'service_video_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
					$filePath 	= "images/service_video/" . $fileName;
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$image = $fileName;
					}
				}
			}
		}


		return $image;
	}


	function upload_image_post($file)
	{


		if (isset($file) && $file['size'] != 0) {

			$allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
			$temp = explode(".", $file["name"]);

			$extension = end($temp);

			if ($file["type"] !== "application/x-msdownload") {

				if (in_array($extension, $allowedExts)) {


					$fileName  = $file["name"];
					$fileSize  = round($file["size"]); // BYTES
					//echo $fileSize ;exit;
					$extension = end(explode(".", $fileName));

					$fileName	= 'post_image_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
					$filePath 	= "images/post_image/" . $fileName;
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$image = $fileName;
					}
				}
			}
		}


		return $image;
	}
	function upload_video_post($file)
	{


		if (isset($file) && $file['size'] != 0) {

			$allowedExts = array("mov", "mp4", "ogg");
			$temp = explode(".", $file["name"]);

			$extension = end($temp);


			if ($file["type"] !== "application/x-msdownload") {

				if (in_array($extension, $allowedExts)) {



					$fileName  = $file["name"];
					$fileSize  = round($file["size"]); // BYTES
					//echo $fileSize ;exit;
					$extension = end(explode(".", $fileName));

					$fileName	= 'post_video_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
					$filePath 	= "images/post_video/" . $fileName;
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$image = $fileName;
					}
				}
			}
		}


		return $image;
	}



	function upload_image_job($file)
	{


		if (isset($file) && $file['size'] != 0) {

			$allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
			$temp = explode(".", $file["name"]);

			$extension = end($temp);

			if ($file["type"] !== "application/x-msdownload") {

				if (in_array($extension, $allowedExts)) {


					$fileName  = $file["name"];
					$fileSize  = round($file["size"]); // BYTES
					//echo $fileSize ;exit;
					$extension = end(explode(".", $fileName));

					$fileName	= 'job_image_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
					$filePath 	= "images/job_image/" . $fileName;
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$image = $fileName;
					}
				}
			}
		}


		return $image;
	}
	function upload_video_job($file)
	{


		if (isset($file) && $file['size'] != 0) {

			$allowedExts = array("mov", "mp4", "ogg");
			$temp = explode(".", $file["name"]);

			$extension = end($temp);


			if ($file["type"] !== "application/x-msdownload") {

				if (in_array($extension, $allowedExts)) {



					$fileName  = $file["name"];
					$fileSize  = round($file["size"]); // BYTES
					//echo $fileSize ;exit;
					$extension = end(explode(".", $fileName));

					$fileName	= 'job_video_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
					$filePath 	= "images/job_video/" . $fileName;
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$image = $fileName;
					}
				}
			}
		}


		return $image;
	}




	function upload_file($file, $is_attach)
	{

		if ($is_attach == 1) {
			if (isset($file) && $file['size'] != 0) {

				$allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
				$temp = explode(".", $file["name"]);

				$extension = end($temp);

				if ($file["type"] !== "application/x-msdownload") {

					if (in_array($extension, $allowedExts)) {


						$fileName  = $file["name"];
						$fileSize  = round($file["size"]); // BYTES
						//echo $fileSize ;exit;
						$extension = end(explode(".", $fileName));

						$fileName	= 'chat_image_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
						$filePath 	= "images/chat_image/" . $fileName;
						if (move_uploaded_file($file['tmp_name'], $filePath)) {
							$image = $fileName;
						}
					}
				}
			}
		} else if ($is_attach == 2) {
			if (isset($file) && $file['size'] != 0) {

				$allowedExts = array("mpeg", "ogg", "mp3", "mp4", "m4a");
				$temp = explode(".", $file["name"]);

				$extension = end($temp);

				if ($file["type"] !== "application/x-msdownload") {

					if (in_array($extension, $allowedExts)) {


						$fileName  = $file["name"];
						$fileSize  = round($file["size"]); // BYTES
						//echo $fileSize ;exit;
						$extension = end(explode(".", $fileName));

						$fileName	= 'chat_audio_' . substr(sha1(time()), 0, 3) . rand(100, 999) . "." . $extension;
						$filePath 	= "images/chat_audio/" . $fileName;
						if (move_uploaded_file($file['tmp_name'], $filePath)) {
							$image = $fileName;
						}
					}
				}
			}
		}

		return $image;
	}
}
