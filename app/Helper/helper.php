<?php

function file_upload_on_aws_for_api($file, $keyName)
{
	// $extension = explode('/', mime_content_type($file))[1];
	// $data = explode( ',', $file);
	// $keyName .= uniqid().'.'.$extension;
	// $path = Storage::disk('s3')->put($keyName, base64_decode($data[1]));
	// // $name = uniqid() . $file->getClientOriginalName();
	// // $path = Storage::disk('s3')->put($keyName, $file);
	// return $path;
	// return Storage::disk('s3')->url($path);

	list($baseType, $image) = explode(';', $file);
	list(, $image) = explode(',', $image);
	$image = base64_decode($image);

	$imageName = uniqid() . '.png';
	$p = Storage::disk('s3')->put($keyName . '/' . $imageName, $image);
	$path = $keyName . '/' . $imageName;
	return $path;
}

function file_upload_on_aws($file, $keyName)
{
	$name = uniqid() . $file->getClientOriginalName();
	$path = Storage::disk('s3')->put($keyName, $file);
	return $path;
	// return Storage::disk('s3')->url($path);
}

function get_file_from_aws($path)
{
	return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(10));
}

?>

