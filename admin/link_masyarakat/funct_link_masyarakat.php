<?php
	
	function buat_id_masyarakat_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_masyarakat_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_masyarakat_link, 2, 4)) AS id FROM tb_masyarakat_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_masyarakat_link = $data['id'];
		$no_urut     = (int) substr($id_masyarakat_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID MASYARAKAT LINK
		$id_masyarakat_link = $char . sprintf("%04s", $no_urut);

		return $id_masyarakat_link;
	}

	function simpan_link_masyarakat($data) {
		global $conn;
		
		$id_masyarakat_link  = buat_id_masyarakat_link();
		$nama_link     = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$show_item     = "N";

		$uploadDir = '../../assets/upload/link_masyarakat/';
		$uploadedFile = ''; 
            if(!empty($_FILES["link"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["link"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('pdf'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["link"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = '/assets/upload/link_masyarakat/'.$fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF file are allowed to upload.'; 
                } 
            } else {
				alert('Error', "Error", 'error');
			}
 

		// SIMPAN DATA LINK MASYARAKAT
		$query = mysqli_query($conn, "INSERT INTO tb_masyarakat_link VALUES(
											'$id_masyarakat_link',  '$nama_link', '$uploadedFile', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_masyarakat($data) {
		global $conn;

		$id_masyarakat_link = mysqli_real_escape_string($conn, htmlspecialchars($data['id_masyarakat_link']));
		$nama_link    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		
		
        if(!empty($_FILES["link"]["name"])){ 
		//GET FILE
		$data = mysqli_query($conn, "SELECT * FROM tb_masyarakat_link WHERE id_masyarakat_link='$id_masyarakat_link'");
		$hasil = mysqli_fetch_row($data);

		//HAPUS FILE
		$path = $hasil[2];
		unlink($_SERVER['DOCUMENT_ROOT'] . $path);

		$uploadDir = '../../assets/upload/link_masyarakat/';
		$uploadedFile = ''; 
            
                // File path config 
                $fileName = basename($_FILES["link"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('pdf'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["link"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = '/assets/upload/link_masyarakat/'.$fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF file are allowed to upload.'; 
                } 
            

        		// UPDATE DATA LINK MASYARAKAT
        		$query = mysqli_query($conn, "UPDATE tb_masyarakat_link SET  nama_masyarakat_link='$nama_link', link_dir_masyarakat='$uploadedFile' 
        									WHERE id_masyarakat_link='$id_masyarakat_link'
        		");
        } else{
                $query = mysqli_query($conn, "UPDATE tb_masyarakat_link SET  nama_masyarakat_link='$nama_link' WHERE id_masyarakat_link='$id_masyarakat_link'");
            
        }

		return mysqli_affected_rows($conn);
	}

	function update_show_link_masyarakat($id, $show) {
		global $conn;

		$id_masyarakat_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_masyarakat_link
		$query = mysqli_query($conn, "UPDATE tb_masyarakat_link SET 
				show_item='$show' 
			WHERE id_masyarakat_link='$id_masyarakat_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_masyarakat($id) {
		global $conn;

		$id_masyarakat_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		//GET FILE
		$data = mysqli_query($conn, "SELECT * FROM tb_masyarakat_link WHERE id_masyarakat_link='$id_masyarakat_link'");
		$hasil = mysqli_fetch_row($data);

		//HAPUS FILE
		$path = $hasil[2];
		unlink($_SERVER['DOCUMENT_ROOT'] . $path);

		// HAPUS DATA LINK MASYARAKAT
		$query = mysqli_query($conn, "DELETE FROM tb_masyarakat_link WHERE id_masyarakat_link='$id_masyarakat_link'");

		

		return mysqli_affected_rows($conn);
	}