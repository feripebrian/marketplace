<?php
	
	function buat_id_zona_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_zona_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_zona_link, 2, 4)) AS id FROM tb_zona_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_zona_link = $data['id'];
		$no_urut     = (int) substr($id_zona_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID ZONA LINK
		$id_zona_link = $char . sprintf("%04s", $no_urut);

		return $id_zona_link;
	}

	function simpan_link_zona($data) {
		global $conn;
		
		$id_zona_link  = buat_id_zona_link();
		$nama_link     = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$show_item     = "N";

		$uploadDir = '../../assets/upload/link_zona/';
		$uploadedFile = ''; 
            if(!empty($_FILES["link"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["link"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["link"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = '/assets/upload/link_zona/'.$fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                } 
            } else {
				alert('Error', "Error", 'error');
			}
 

		// SIMPAN DATA LINK ZONA
		$query = mysqli_query($conn, "INSERT INTO tb_zona_link VALUES(
											'$id_zona_link',  '$nama_link', '$uploadedFile', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_zona($data) {
		global $conn;

		$id_zona_link = mysqli_real_escape_string($conn, htmlspecialchars($data['id_zona_link']));
		$nama_link    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));

		//GET FILE
		$data = mysqli_query($conn, "SELECT * FROM tb_zona_link WHERE id_zona_link='$id_zona_link'");
		$hasil = mysqli_fetch_row($data);

		//HAPUS FILE
		$path = $hasil[2];
		unlink($_SERVER['DOCUMENT_ROOT'] . $path);

		$uploadDir = '../../assets/upload/link_zona/';
		$uploadedFile = ''; 
            if(!empty($_FILES["link"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["link"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["link"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = '/assets/upload/link_zona/'.$fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                } 
            } else {
				alert('Error', "Error", 'error');
			}

		// UPDATE DATA LINK ZONA
		$query = mysqli_query($conn, "UPDATE tb_zona_link SET  nama_zona_link='$nama_link', link_dir_zona='$uploadedFile' 
									WHERE id_zona_link='$id_zona_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_zona($id, $show) {
		global $conn;

		$id_zona_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_zona_link
		$query = mysqli_query($conn, "UPDATE tb_zona_link SET 
				show_item='$show' 
			WHERE id_zona_link='$id_zona_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_zona($id) {
		global $conn;

		$id_zona_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		//GET FILE
		$data = mysqli_query($conn, "SELECT * FROM tb_zona_link WHERE id_zona_link='$id_zona_link'");
		$hasil = mysqli_fetch_row($data);

		//HAPUS FILE
		$path = $hasil[2];
		unlink($_SERVER['DOCUMENT_ROOT'] . $path);

		// HAPUS DATA LINK ZONA
		$query = mysqli_query($conn, "DELETE FROM tb_zona_link WHERE id_zona_link='$id_zona_link'");

		

		return mysqli_affected_rows($conn);
	}