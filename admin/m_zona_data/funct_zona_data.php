<?php
	
	function buat_id_zona_data() {
		global $conn;

		// MENCARI NILAI MAX PADA id_zona_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_data_link, 2, 4)) AS id FROM tb_zona_data";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_data_link = $data['id'];
		$no_urut     = (int) substr($id_data_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID ZONA LINK
		$id_data_link = $char . sprintf("%04s", $no_urut);

		return $id_data_link;
	}

	function simpan_link_data($data) {
		global $conn;
		
		$id_data_link  		= buat_id_zona_data();
		$nama_data_link     = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_data_link']));
		$show_item    		= "N";

		$uploadDir = '../../assets/upload/zona_data/';
		$uploadedFile = ''; 
            if(!empty($_FILES["link"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["link"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('pdf', 'xls', 'xlsx', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["link"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = '/assets/upload/zona_data/'.$fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, XLS, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                } 
            } else {
				echo "
				<script>
					alert('Gagal! File Upload tidak ditemukan.');
				</script>
			";
			}
 

		// SIMPAN DATA LINK ZONA
		$query = mysqli_query($conn, "INSERT INTO tb_zona_data VALUES(
											'$id_data_link',  '$nama_data_link', '$uploadedFile', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_data($data) {
		global $conn;

		$id_data_link = mysqli_real_escape_string($conn, htmlspecialchars($data['id_data_link']));
		$nama_data_link    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_data_link']));

		//GET FILE
		$data = mysqli_query($conn, "SELECT * FROM tb_zona_data WHERE id_data_link='$id_data_link'");
		$hasil = mysqli_fetch_row($data);

		//HAPUS FILE
		$path = $hasil[2];
		unlink($_SERVER['DOCUMENT_ROOT'] . $path);

		$uploadDir = '../../assets/upload/zona_data/';
		$uploadedFile = ''; 
            if(!empty($_FILES["link"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["link"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('pdf','xls', 'xlsx', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["link"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = '/assets/upload/zona_data/'.$fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, XLS, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                } 
            } else {
				echo "
				<script>
					alert('Gagal! File Upload tidak ditemukan.');
				</script>
			";
			}

		// UPDATE DATA LINK ZONA
		$query = mysqli_query($conn, "UPDATE tb_zona_data SET  nama_data_link='$nama_data_link', link_dir_data='$uploadedFile' 
									WHERE id_data_link='$id_data_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_zona($id, $show) {
		global $conn;

		$id_data_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_zona_link
		$query = mysqli_query($conn, "UPDATE tb_zona_data SET 
				show_item='$show' 
			WHERE id_data_link='$id_data_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_zona($id) {
		global $conn;

		$id_data_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		//GET FILE
		$data = mysqli_query($conn, "SELECT * FROM tb_zona_data WHERE id_data_link='$id_data_link'");
		$hasil = mysqli_fetch_row($data);

		//HAPUS FILE
		$path = $hasil[2];
		unlink($_SERVER['DOCUMENT_ROOT'] . $path);

		// HAPUS DATA LINK ZONA
		$query = mysqli_query($conn, "DELETE FROM tb_zona_data WHERE id_data_link='$id_data_link'");

		

		return mysqli_affected_rows($conn);
	}