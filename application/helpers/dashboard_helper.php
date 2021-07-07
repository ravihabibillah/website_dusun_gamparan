<?php

function statusData($condition)
{
	if ($condition) {
		return "<div class='btn btn-primary'>Publish</div>";
	} else {
		return "<div class='btn btn-danger'>Unpublish</div>";
	}
}

function setMessage($process, $action)
{
	if ($process) {
		return [
			"result" => true,
			"message" => "<div class='alert alert-success'>Berhasil " . $action . " data</div>"
		];
	} else {
		return [
			"result" => false,
			"message" => "<div class='alert alert-danger'>Gagal " . $action . " data</div>"
		];
	}
}

function doUploadFile($path)
{
	$ci = &get_instance();

	## Create Folder If not Exist
	if (!is_dir("./storage/{$path}")) {
	    mkdir("./storage/{$path}", 0777, TRUE);
	}

	$config['allowed_types'] = "pdf|doc|docx|ppt|pptx";
	$config['max_size'] = 5000;
	$config['upload_path'] = "./storage/{$path}";
	$config['overwrite'] = true;

	$ci->load->library('upload', $config);

	if (!$ci->upload->do_upload('attach')) {
		return [
			'result' => false,
			'message' => "<small class='text-danger'>" . $ci->upload->display_errors() . "</small>"
		];
	}

	return [
		'result' => true,
		'data' => $ci->upload->data('file_name')
	];
}

function doUploadImage($path)
{
	$ci = &get_instance();

	## Create Folder If not Exist
	if (!is_dir("./storage/{$path}")) {
	    mkdir("./storage/{$path}", 0777, TRUE);
	}

	$config['allowed_types'] = "gif|jpg|jpeg|png|jfif|bmp";
	$config['max_size'] = 10240;
	$config['upload_path'] = "./storage/{$path}";
	$config['overwrite'] = true;

	$ci->load->library('upload', $config);

	if (!$ci->upload->do_upload('image')) {
		return [
			'result' => false,
			'message' => "<small class='text-danger'>" . $ci->upload->display_errors() . "</small>"
		];
	}

	return [
		'result' => true,
		'data' => $ci->upload->data('file_name')
	];
}

function doUploadMultipleFile($path, $files)
{
	$ci = &get_instance();

	## Create Folder If not Exist
	if (!is_dir("./storage/{$path}")) {
	    mkdir("./storage/{$path}", 0777, TRUE);
	}

	$config['allowed_types'] = "pdf|doc|docx|ppt|pptx|xls|xlsx|rtf|gif|jpg|jpeg|png|bmp";
	$config['max_size'] = 51200;
	$config['upload_path'] = "./storage/{$path}";
	$config['overwrite'] = true;

	$ci->load->library('upload', $config);

	$attach = array('result' => true, 'data' => array());

	$total = count($files['tmp_name']);

    for ($key = 0; $key < $total; $key++) {
        $_FILES['attach']['name']= $files['name'][$key];
        $_FILES['attach']['type']= $files['type'][$key];
        $_FILES['attach']['tmp_name']= $files['tmp_name'][$key];
        $_FILES['attach']['error']= $files['error'][$key];
        $_FILES['attach']['size']= $files['size'][$key];

        if (!$ci->upload->do_upload('attach')) {
			$attach = array(
				'result' => false,
				'message' => "<small class='text-danger'>" . $ci->upload->display_errors() . "</small>"
			);
			break;
        } else {
            array_push($attach['data'], $ci->upload->data('file_name'));
        }
    }

    return $attach;
}

function deleteFile($folder, $file_name)
{
	$file = FCPATH . "storage/" . $folder . "/" . $file_name;
	return unlink($file);
}

function deleteFolderWithFiles($folder)
{
	$dir = FCPATH . "storage/" . $folder;
	$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
	$files = new RecursiveIteratorIterator($it,
	             RecursiveIteratorIterator::CHILD_FIRST);
	foreach($files as $file) {
	    if ($file->isDir()){
	        rmdir($file->getRealPath());
	    } else {
	        unlink($file->getRealPath());
	    }
	}
	rmdir($dir);
}

function create_log($keterangan, $jenis = '', $id_user = '0', $jenis_data = '-', $is_success)
{
	$ci = &get_instance();
	$ci->load->model('Log_model', 'log_m');

	$ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $url = $_SERVER['REQUEST_URI'];

	$log = [
		'ip' 			=> $ip,
		'url' 			=> $url,
		'user_agent' 	=> $user_agent,
		'id_user' 		=> $id_user,
		'jenis' 		=> $jenis,
		'jenis_data'	=> $jenis_data,
		'keterangan'	=> $keterangan,
		'is_success' 	=> $is_success
	];

    $ci->log_m->insert($log);
}

function renameFolderUser($old_username, $new_username)
{
	$dir = FCPATH . "storage/user/";
	$oldname = $dir . $old_username;

	// Get the directory name
	$old_dir_name = substr($oldname, strrpos($oldname, '/') + 1);

	// Replace Folder Name
	$new_dir_name = str_replace($old_username, $new_username, $old_dir_name);

	// Define the new directory
	$newname = $dir . $new_dir_name;

	// Renames the directory
	rename($oldname, $newname);
}