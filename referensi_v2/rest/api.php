<?php
    
	/* 
		This is an example class script proceeding secured API
		To use this class you should keep same as query string and function name
		Ex: If the query string value rquest=delete_user Access modifiers doesn't matter but function should be
		     function delete_user(){
				 You code goes here
			 }
		Class will execute the function dynamically;
		
		usage :
		
		    $object->response(output_data, status_code);
			$object->_request	- to get santinized input 	
			
			output_data : JSON (I am using)
			status_code : Send status message for headers
			
		Add This extension for localhost checking :
			Chrome Extension : Advanced REST client Application
			URL : https://chrome.google.com/webstore/detail/hgmloofddffdnphfgcellkdfbfbjeloo
		
		I used the below table for demo purpose.
		
		CREATE TABLE IF NOT EXISTS `users` (
		  `user_id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_fullname` varchar(25) NOT NULL,
		  `user_email` varchar(50) NOT NULL,
		  `user_password` varchar(50) NOT NULL,
		  `user_status` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`user_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 	*/
	
	require_once("Rest.inc.php");
	
	class API extends REST {
	
		public $data = "";
		
		//$link = mysql_connect("$hostname:$port", $username, $password);
		//$db_selected = mysql_select_db($db, $link);
		
		
		/*
		const DB_SERVER = "localhost";
		const DB_USER = "root";
		const DB_PASSWORD = "";
		const DB = "mytask";
		*/
		
		private $db = NULL;
	
		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();					// Initiate Database connection
		}
		
		/*
		 *  Database connection 
		*/
		private function dbConnect(){
			$services_json = json_decode(getenv("VCAP_SERVICES"),true);
			$mysql_config = $services_json["mysql-5.1"][0]["credentials"];
			$port = $mysql_config["port"];
			
			$DB_SERVER = $mysql_config["hostname"];
			$DB_USER = $mysql_config["username"];
			$DB_PASSWORD = $mysql_config["password"];
			$DB = $mysql_config["name"];
			
			$this->db = mysql_connect("$DB_SERVER:$port",$DB_USER,$DB_PASSWORD);
			if($this->db)
				mysql_select_db($DB,$this->db);
		}
		
		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);				// If the method not exist with in this class, response would be "Page not found".
		}
		
		/* 
		 *	Simple login API
		 *  Login must be POST method
		 *  email : <USER EMAIL>
		 *  pwd : <USER PASSWORD>
		 */
		// STEFAN WAS HERE
		private function logincheck(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			
			$username = $this->_request['username'];		
			$password = $this->_request['password'];
			
			// Input validations
			if(!empty($username) and !empty($password)){
					$sql = mysql_query("SELECT * FROM user WHERE username = '$username' AND password='$password'");
					if(mysql_num_rows($sql) == 1){
						$result = mysql_fetch_array($sql,MYSQL_ASSOC);
						
						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);
					}
					$this->response('', 204);	// If no records "No Content" status
				//}
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		private function edit_tag(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$idtag = $this->_request['idtag'];
			$tag = $this->_request['tag'];
			
			// Input validations
			if(!empty($idtag)){
				$sql = mysql_query("DELETE FROM tag WHERE idtask='$idtag'");
				
				$tagex = explode(',', $tag);
				foreach ($tagex as $tagin) {
					$querytag = "INSERT INTO `tag` (`idtask`,`namatag`) VALUES ('$idtag','$tagin')" ;
					mysql_query($querytag) ;
				}
				
				$sql2 = mysql_query("select * from tag where idtask= '$idtag'");
				
				$result = array();
				while($rlt = mysql_fetch_array($sql2, MYSQL_ASSOC)){
					$result[] = $rlt['namatag'];
				}
					
				// If success everythig is good send header as "OK" and user details
				$this->response($this->json($result), 200);
			} else {
				$this->response('', 204);	// If no records "No Content" status
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		// STEFAN WAS HERE
		private function edit_task(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$idtask = $this->_request['idtask'];
			$assignee = $this->_request['assignee'];
			
			// Input validations
			if(!empty($idtask) and !empty($assignee)){
					$sql = mysql_query("insert into assignee (idtask,nama_user) values ('$idtask','$assignee')");
					
					$sql2 = mysql_query("select * from assignee where idtask= '$idtask'");
					
					$result1 = array();
					while($rlt = mysql_fetch_array($sql2, MYSQL_ASSOC)){
						$result[] = $rlt;
					}
						
					// If success everythig is good send header as "OK" and user details
					$this->response($this->json($result), 200);
			} else {
				$this->response('', 204);	// If no records "No Content" status
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		// STEFAN WAS HERE
		private function update(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$id = $this->_request['id'];		
			$deadline = $this->_request['deadline'];
			
			// Input validations
			if(!empty($id) and !empty($deadline)){
					$sql = mysql_query("update tugas set deadline='$deadline' where id= '$id'");
					
					$sql2 = mysql_query("select * from tugas where id= '$id'");
					
					$result = array();
					while($rlt = mysql_fetch_array($sql2, MYSQL_ASSOC)){
						$result[] = $rlt;
					}
					// If success everythig is good send header as "OK" and user details
					$this->response($this->json($result), 200);
			}else{
				$this->response('', 204);	// If no records "No Content" status
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		// STEFAN WAS HERE
		private function tampilkat(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$id = $this->_request['id'];		
			
			// Input validations
			if(!empty($id)){
					$sql = mysql_query("select * from kategori");
					
					if(mysql_num_rows($sql) > 0){
						$result = mysql_fetch_array($sql,MYSQL_ASSOC);
						
						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);
					}
					$this->response('', 204);	// If no records "No Content" status
				//}
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		// STEFAN WAS HERE
		private function deletekat(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			$username = $this->_request['username'];
			
			// Input validations
			if(!empty($id) and !empty($username)){
					$sql = mysql_query("DELETE FROM kategori WHERE id='$id'");
					
					$sql2 = mysql_query("SELECT id FROM user WHERE username LIKE '".$username."'");
					
					$result_1 = mysql_fetch_array($sql2,MYSQL_ASSOC);
					
					$sql3 = mysql_query("select * from kategori");
					$result_2 = array();
					while ($rlt = mysql_fetch_array($sql3,MYSQL_ASSOC)) {
						$result_2[] = $rlt;
					}
					
					$result = array();
					$result['loginid'] = $result_1;
					$result['hasilkat'] = $result_2;
					// If success everythig is good send header as "OK" and user details
					$this->response($this->json($result), 200);
					
			}else{
				$this->response('', 204);	// If no records "No Content" status
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		// STEFAN WAS HERE
		private function delass(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			$username = $this->_request['username'];
			
			// Input validations
			if(!empty($id) and !empty($username)){
					$sql = mysql_query("DELETE FROM assignee WHERE nama_user='$username'");
					
					$sql2 = mysql_query("select * from assignee where idtask= '$id'");

					$result = array();
					while($rlt = mysql_fetch_array($sql2, MYSQL_ASSOC)){
						$result[] = $rlt;
					}
					
					// If success everythig is good send header as "OK" and user details
					$this->response($this->json($result), 200);
			}else{
				$this->response('', 204);	// If no records "No Content" status
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		// STEFAN WAS HERE
		private function del_komen(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			$idtask = $this->_request['idtask'];
			
			// Input validations
			if(!empty($id) and !empty($idtask)){
					$sql = mysql_query("DELETE FROM komentar WHERE id='$id'");
					
					$sql2 = mysql_query("SELECT COUNT(id) as jumlah FROM komentar where idtask='$idtask'");

					if(mysql_num_rows($sql2) > 0){
						$result = mysql_fetch_array($sql2,MYSQL_ASSOC);
						
						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);
					}
					$this->response('', 204);	// If no records "No Content" status
				//}
			}
			
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
		
		// STEFAN DAN PABOT WAS HERE
		private function detail(){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			$username = $this->_request['username'];
			$rowsperpage = $this->_request['rowsperpage'];
			$offset = $this->_request['offset'];
			
			/* LOGIN */
			$sqllogin = mysql_query("SELECT id FROM user WHERE username LIKE '$username'");
				
			$resultlogin = mysql_fetch_array($sqllogin,MYSQL_ASSOC);
			$idlogin = $resultlogin['id'];
			
			$sqllogin2 = mysql_query("SELECT * FROM user WHERE id=$idlogin");
			$resultlogin = mysql_fetch_array($sqllogin2,MYSQL_ASSOC);
			
			/* KOMENTAR */
			$sqljumlah = mysql_query("SELECT COUNT(id) as jumlah FROM komentar where idtask='$id'");
			$rjumlah = mysql_fetch_row($sqljumlah);
			$jumlah = $rjumlah[0];
			
			$sql = mysql_query("select *, user.id as uid, komentar.id as kid from komentar,user where idtask= '$id' and user.id=komentar.iduser order by kid DESC LIMIT $offset, $rowsperpage");
			$hasil = array();
			while ($rlt = mysql_fetch_array($sql,MYSQL_ASSOC)) {
				$hasil[] = $rlt;
			}
			
			/* TUGAS */
			$sqltugas = mysql_query("SELECT * FROM tugas WHERE id=$id");
			$tugas = mysql_fetch_array($sqltugas,MYSQL_ASSOC);
			
			$sqlass = mysql_query("select username from `assignee`,`user`,`tugas` where assignee.idtask = $id and tugas.id = $id and assignee.nama_user = user.username");
			$ass = array();
			while ($rlt2 = mysql_fetch_array($sqlass,MYSQL_ASSOC)) {
				$ass[] = $rlt2['username'];
			}
			$tugas['assignee'] = $ass;
			
			/* ATTACHMENT */
			$sqlatt = mysql_query("SELECT * from `attachment` where attachment.idtask = '$id'");
			$att = array();
			while ($rlt3 = mysql_fetch_array($sqlatt,MYSQL_ASSOC)) {
				$att[] = $rlt3;
			}
			
			/* ASSIGNEE */
			$sqlass2 = mysql_query("select * from assignee where idtask=$id");
			$assi = array();
			while ($rlt = mysql_fetch_array($sqlass2,MYSQL_ASSOC)) {
				$assi[] = $rlt;
			}
			
			/* TAG */
			$sqltag = mysql_query("select * from tag where idtask=$id");
			$tag = array();
			while ($rlt2 = mysql_fetch_array($sqltag,MYSQL_ASSOC)) {
				$tag[] = $rlt2['namatag'];
			}
			
			/* RESULT */
			$result = array();
			$result['login'] = $resultlogin;
			$result['jumlahkom'] = $jumlah;
			$result['komentar'] = $hasil;
			$result['tugas'] = $tugas;
			$result['assignee'] = $assi;
			$result['attachment'] = $att;
			$result['tag'] = $tag;

			// If success everythig is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function users(){	
			// Cross validation if the request method is GET else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$sql = mysql_query("SELECT user_id, user_fullname, user_email FROM users WHERE user_status = 1", $this->db);
			if(mysql_num_rows($sql) > 0){
				$result = array();
				while($rlt = mysql_fetch_array($sql,MYSQL_ASSOC)){
					$result[] = $rlt;
				}
				// If success everythig is good send header as "OK" and return list of users in JSON format
				$this->response($this->json($result), 200);
			}
			$this->response('',204);	// If no records "No Content" status
		}
		
		private function deleteUser(){
			// Cross validation if the request method is DELETE else it will return "Not Acceptable" status
			if($this->get_request_method() != "DELETE"){
				$this->response('',406);
			}
			$id = (int)$this->_request['id'];
			if($id > 0){				
				mysql_query("DELETE FROM users WHERE user_id = $id");
				$success = array('status' => "Success", "msg" => "Successfully one record deleted.");
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// If no records "No Content" status
		}
		
		/* =========== Pabot ============ */
		private function insert() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$username = $this->_request['username'];
			$namakat = $this->_request['namakat'];
			
			$sql = mysql_query("SELECT * FROM user WHERE username = $username");
			$login = mysql_fetch_array($sql,MYSQL_ASSOC);
			$id = $login['id'];
			
			$simpan = mysql_query("insert into kategori (namakat,idcreator) values ('$namakat','$id')");
			if ($simpan)
				$this->response($this->json(array("oke")), 200);
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function insertReg() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$user = $this->_request['user'];
			$pass = $this->_request['pass'];
			$name = $this->_request['name'];
			$email = $this->_request['email'];
			$date = $this->_request['date'];
			$ava = $this->_request['ava'];
			
			mysql_query("INSERT INTO `user`(`username`, `password`, `fullname`, `email`, `birthdate`, `avatar`) VALUES ('$user','$pass','$name','$email','$date','$ava')");
		}
		
		private function changeStat() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			
			$sql = mysql_query("SELECT * FROM tugas WHERE id = $id");
			$hasil = mysql_fetch_array($sql,MYSQL_ASSOC);
			
			if ($hasil['status'] == 1) {
				$simpan = mysql_query("UPDATE tugas SET status = 0 WHERE id = $id");
				$this->response($this->json(array("Belum selesai")),200);
			} else if ($hasil['status'] == 0) {
				$simpan = mysql_query("UPDATE tugas SET status = 1 WHERE id = $id");
				$this->response($this->json(array("Selesai")),200);
			}
		}
		
		private function dashboard() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan GET
			}
			
			$username = $this->_request["username"];
			
			$sqllogin = mysql_query("SELECT id FROM user WHERE username LIKE '$username'");
				
			$resultlogin = mysql_fetch_array($sqllogin,MYSQL_ASSOC);
			$idlogin = $resultlogin['id'];
			
			$sqllogin2 = mysql_query("SELECT * FROM user WHERE id=$idlogin");
			$resultlogin = mysql_fetch_array($sqllogin2,MYSQL_ASSOC);
			
			$sqlkat = mysql_query("SELECT * FROM kategori");
			$hasilkat = array();
			while($rlt = mysql_fetch_array($sqlkat,MYSQL_ASSOC)){
				$hasilkat[] = $rlt;
			}
			
			$sqltask = mysql_query("SELECT * FROM tugas");
			$tugas = array();
			while($rlt = mysql_fetch_array($sqltask,MYSQL_ASSOC)){
				$sqltag = mysql_query("SELECT * FROM tag WHERE idtask = ".$rlt['id']);
				$tag = array();
				while ($rlt1 = mysql_fetch_array($sqltag,MYSQL_ASSOC)) {
					$tag[] = $rlt1['namatag'];
				}
				$rlt['tag'] = $tag;
				$tugas[] = $rlt;
			}
			
			$result = array();
			$result['login'] = $resultlogin;
			$result['kategori'] = $hasilkat;
			$result['tugas'] = $tugas;
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function addTask() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan GET
			}
			
			$username = $this->_request["username"];
			$idkat = $this->_request["idkat"];
			
			$sqllogin = mysql_query("SELECT id FROM user WHERE username LIKE '$username'");
				
			$resultlogin = mysql_fetch_array($sqllogin,MYSQL_ASSOC);
			$idlogin = $resultlogin['id'];
			
			$sqllogin2 = mysql_query("SELECT * FROM user WHERE id=$idlogin");
			$resultlogin = mysql_fetch_array($sqllogin2,MYSQL_ASSOC);
			
			$sqlkat = mysql_query("SELECT namakat FROM kategori WHERE id = $idkat");
			$hasilkat = mysql_fetch_array($sqlkat,MYSQL_ASSOC);
			$namakat = $hasilkat['namakat'];
			
			
			$result = array();
			$result['login'] = $resultlogin;
			$result['namakat'] = $namakat;
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function addTaskSuggest() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$sql = mysql_query("SELECT username FROM user");
			$user = mysql_fetch_array($sql,MYSQL_ASSOC);
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($user), 200);
		}
		
		private function tagSuggest() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$sql = mysql_query("SELECT namatag FROM tag");
			$tag = array();
			while ($rlt = mysql_fetch_array($sql,MYSQL_ASSOC))
				$tag[] = $rlt;
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($tag), 200);
		}
		
		private function regCheck() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$u = $this->_request['u'];
			$e = $this->_request['e'];
			
			$query = "SELECT * FROM user WHERE username = '$u'" ;
			$query2 = "SELECT * FROM user WHERE email = '$e'" ;

			$result = mysql_query($query) ;
			$result2 = mysql_query($query2) ;

			$count = mysql_num_rows($result) ;
			$count2 = mysql_num_rows($result2) ;
			
			$result = array();
			$result['count'] = $count;
			$result['count2'] = $count2;
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function processComment() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			$komentar = $this->_request['komentar'];
			$uid = $this->_request['uid'];
			$date = $this->_request['date'];
			$rowsperpage = $this->_request['rowsperpage'];
			$offset = $this->_request['offset'];
			
			$simpan = mysql_query("insert into komentar (idtask,iduser,komentar,waktu) values ('$id','$uid','$komentar', '$date')");
			$sqljumlah = mysql_query("SELECT COUNT(id) as jumlah FROM komentar where idtask='$id'");
			$rjumlah = mysql_fetch_row($sqljumlah);
			$jumlah = $rjumlah[0];
			
			$sql = mysql_query("select *, user.id as uid, komentar.id as kid from komentar,user where idtask= '$id' and user.id=komentar.iduser order by kid DESC LIMIT $offset, $rowsperpage");
			$hasil = array();
			while ($rlt = mysql_fetch_array($sql,MYSQL_ASSOC)) {
				$hasil[] = $rlt;
			}
			
			$result = array();
			$result['jumlah'] = $jumlah;
			$result['hasil'] = $hasil;
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function deleteCat() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			
			$sql = mysql_query("DELETE FROM kategori WHERE id = $id");
			if ($sql) {
				$hasil = array("Oke");
				// If success everything is good send header as "OK" and user details
				$this->response($this->json($hasil), 200);
			}
			$this->response($this->json(array("No")),200);	
		}
		
		private function deleteTask() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			
			$delkom = mysql_query("DELETE FROM komentar WHERE idtask='$id'");
			$deltag = mysql_query("DELETE FROM tag WHERE idtask='$id'");
			$delass = mysql_query("DELETE FROM assignee WHERE idtask='$id'");
			$del = mysql_query("DELETE FROM tugas WHERE id='$id'");
			
			if ($delkom and $deltag and $delass and $del) {
				$this->response($this->json(array("Oke")),200);
			} else {
				$this->response($this->json(array("No")),200);
			}
		}
		
		private function changeCat() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);
			}
			
			$id = $this->_request['id'];
			$username = $this->_request['username'];
			
			$sqllogin = mysql_query("SELECT id FROM user WHERE username LIKE '$username'");
				
			$resultlogin = mysql_fetch_array($sqllogin,MYSQL_ASSOC);
			$idlogin = $resultlogin['id'];
			
			$sqllogin2 = mysql_query("SELECT * FROM user WHERE id=$idlogin");
			$resultlogin = mysql_fetch_array($sqllogin2,MYSQL_ASSOC);
			
			$sql = mysql_query("select * from tugas where idkat = '$id'");
			$tugas = array();
			while($rlt = mysql_fetch_array($sql,MYSQL_ASSOC)){
				$idtask = $rlt['id'];
				$sqltag = mysql_query("select * from tag where idtask = $idtask");
				$tag = array();
				while ($rlt2 = mysql_fetch_array($sqltag,MYSQL_ASSOC)) {
					$tag[] = $rlt2['namatag'];
				}
				$rlt['tag'] = $tag;
				$tugas[] = $rlt;
			}
			
			$result = array();
			$result['tugas'] = $tugas;
			$result['login'] = $resultlogin;
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function profile() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan GET
			}
			$login = $this->_request['login'];				// Get 'username' parameter
			$profile = $this->_request['profile'];
			
			if (!empty($login) and !empty($profile)) {						// Kalo username udah set
				$sqllogin1 = mysql_query("SELECT id FROM user WHERE username LIKE '$login'");
				$sqlprofile1 = mysql_query("SELECT id FROM user WHERE username LIKE '$profile'");
				
				$resultlogin1 = mysql_fetch_array($sqllogin1,MYSQL_ASSOC);
				$resultprofile1 = mysql_fetch_array($sqlprofile1,MYSQL_ASSOC);
				$idlogin = $resultlogin1['id'];
				$idprofile = $resultprofile1['id'];
				
				$sqllogin2 = mysql_query("SELECT * FROM user WHERE id=$idlogin");
				$sqlprofile2 = mysql_query("SELECT * FROM user WHERE id=$idprofile");
				$resultlogin = mysql_fetch_array($sqllogin2,MYSQL_ASSOC);
				$resultprofile = mysql_fetch_array($sqlprofile2,MYSQL_ASSOC);
				
				$sql_on = mysql_query("SELECT * FROM assignee as a, tugas as t WHERE a.idtask = t.id AND a.nama_user LIKE '$profile' AND status=0");
				$sql_done = mysql_query("SELECT * FROM assignee as a, tugas as t WHERE a.idtask = t.id AND a.nama_user LIKE '$profile' AND status=1");
				
				$result_on = array();
				while($rlt = mysql_fetch_array($sql_on,MYSQL_ASSOC)){
					$result_on[] = $rlt;
				}
				
				$result_done = array();
				while($rlt = mysql_fetch_array($sql_done,MYSQL_ASSOC)){
					$result_done[] = $rlt;
				}
			
				$result = array();
				$result['login'] = $resultlogin;
				$result['profile'] = $resultprofile;
				$result['on'] = $result_on;
				$result['done'] = $result_done;
				
				// If success everything is good send header as "OK" and user details
				$this->response($this->json($result), 200);
			}
			$this->response('', 204);		// No username
		}
		
		private function updateProfile() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan GET
			}
			
			$login = $this->_request['login'];				// Getting the parameteeeeerrrss
			$valid = (int)$this->_request['valid'];
			$id = $this->_request['id'];
			$fullname = $this->_request['fullname'];
			$email = $this->_request['email'];
			$birthdate = $this->_request['birthdate'];
			
			if ($valid != 0) {
				mysql_query("UPDATE user SET fullname = '".$fullname."', email = '".$email."', birthdate = '".$birthdate."' WHERE id = " . $id);
			}
			
			if (!empty($login)) {
				$sqllogin = mysql_query("SELECT id FROM user WHERE username LIKE '$login'");
				
				$resultlogin = mysql_fetch_array($sqllogin,MYSQL_ASSOC);
				$idlogin = $resultlogin['id'];
				
				$sqllogin2 = mysql_query("SELECT * FROM user WHERE id=$idlogin");
				$resultlogin = mysql_fetch_array($sqllogin2,MYSQL_ASSOC);
				
				// If success everything is good send header as "OK" and user details
				$this->response($this->json($resultlogin), 200);
			}
			$this->response('', 204);		// No username
		}
		
		private function updatePassword() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan GET
			}
			
			$user = $this->_request['user'];
			$continue = (int)$this->_request['continue'];
			$newpass = $this->_request['newpass'];
				
			$sql = mysql_query("SELECT * FROM user WHERE username LIKE '$user'");
			$result = mysql_fetch_array($sql,MYSQL_ASSOC);
			
			if ($continue == 1)
				mysql_query("UPDATE user SET password = '" . $newpass . "' WHERE id = " . $result['id']);
				
			$pass = $result['password'];
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($pass), 200);
		}
		
		private function changeAvatar() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan GET
			}
			
			$username = $this->_request['username'];
			$avatar = $this->_request['avatar'];
				
			$sql = mysql_query("SELECT * FROM user WHERE username LIKE '$username'");
			$result = mysql_fetch_array($sql,MYSQL_ASSOC);
			$id = $result['id'];
			
			mysql_query("UPDATE user SET avatar='".$avatar."' WHERE id=".$id);
			
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($pass), 200);
		
		}
		
		private function searchResults() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan POST
			}
			
			$username = $this->_request['username'];		// Get 'username' parameter
			$query = $this->_request['query'];				// Get 'status' parameter
			if (isset($this->_request['u']))
				$u = $this->_request['u'];						// Get u parameter, buat filtering search (username)
			if (isset($this->_request['t']))
				$t = $this->_request['t'];						// Get t parameter, buat filtering search (task)
			if (isset($this->_request['c']))
				$c = $this->_request['c'];						// Get c parameter, buat filtering search (category)

			$sqlid = mysql_query("SELECT id FROM user WHERE username LIKE '$username'");
			$result1 = mysql_fetch_array($sqlid,MYSQL_ASSOC);
			$id = $result1['id'];
				
			$sqlprofile = mysql_query("SELECT * FROM user WHERE id=$id");
			$profile = mysql_fetch_array($sqlprofile,MYSQL_ASSOC);		// Hasil profile
				
			if (isset($u)) {
				$sqlcountu = mysql_query("SELECT COUNT(*) FROM user WHERE username LIKE '%$query%' OR email LIKE '%$query%' OR fullname LIKE '%$query%'");
				$countu = mysql_fetch_row($sqlcountu);	// Hasil count user
				$sqlu = mysql_query("SELECT * FROM user WHERE username LIKE '%$query%' OR email LIKE '%$query%' OR fullname LIKE '%$query%' LIMIT 0,5");
				$resultu = array();		// Hasil data user
				if(mysql_num_rows($sqlu) > 0){
					while ($rlt = mysql_fetch_array($sqlu,MYSQL_ASSOC)) {
						$resultu[] = $rlt;
					}
				}
			}
			if (isset($c)) {
				$sqlcountc = mysql_query("SELECT COUNT(*) FROM kategori WHERE namakat LIKE '%$query%'");
				$countc = mysql_fetch_row($sqlcountc);		// Hasil count category
				$sqlc = mysql_query("SELECT * FROM kategori WHERE namakat LIKE '%$query%' LIMIT 0,5");
				$resultc = array();		// Hasil data category
				if(mysql_num_rows($sqlc) > 0){
					while ($rlt = mysql_fetch_array($sqlc,MYSQL_ASSOC)) {
						$resultc[] = $rlt;
					}
				}
			}
			if (isset($t)) {
				$sqlcountt = mysql_query("SELECT COUNT(*) FROM tugas WHERE namatask LIKE '%$query%'");
				$countt = mysql_fetch_row($sqlcountt);		// Hasil count task
				$sqlt = mysql_query("SELECT * FROM tugas WHERE namatask LIKE '%$query%' LIMIT 0,5");
				$resultt = array();		// Hasil data task
				if(mysql_num_rows($sqlt) > 0){
					while ($rlt = mysql_fetch_array($sqlt,MYSQL_ASSOC)) {
						$namatask = $rlt['namatask'];
						$sqltag = mysql_query("SELECT * FROM tugas as tu, tag as t WHERE tu.id=t.idtask AND namatask LIKE '$namatask'");
						$tag = array();
						while ($rlttag = mysql_fetch_array($sqltag,MYSQL_ASSOC)) {
							$tag[] = $rlttag['namatag'];
						}
						$rlt['tag'] = $tag;
						$idkat = $rlt['idkat'];
						$sql_namakat = mysql_query("SELECT namakat FROM kategori WHERE id = ".$idkat);
						$namakat = mysql_fetch_row($sql_namakat);
						$rlt['namakat'] = $namakat[0];
						$resultt[] = $rlt;
					}
				}
			}
			
			$result = array();
			$result['profile'] = $profile;
			if (isset($u)) {
				$result['rowsu'] = $countu[0];
				$result['user'] = $resultu;
			}
			if (isset($c)) {
				$result['rowsc'] = $countc[0];
				$result['category'] = $resultc;
			}
			if (isset($t)) {
				$result['rowst'] = $countt[0];
				$result['task'] = $resultt;
			}
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		private function searchClassified() {
			if ($this->get_request_method() != "POST") {
				$this->response('',406);					// Kalo bukan POST
			}
			
			$username = $this->_request['username'];		// Get 'username' parameter
			$query = $this->_request['query'];				// Get 'status' parameter
			$filter = $this->_request['filter'];
			$offset = $this->_request['offset'];
			$rowsperpage = $this->_request['rowsperpage'];
			
			$sqlid = mysql_query("SELECT id FROM user WHERE username LIKE '$username'");
			$result1 = mysql_fetch_array($sqlid,MYSQL_ASSOC);
			$id = $result1['id'];
				
			$sqlprofile = mysql_query("SELECT * FROM user WHERE id=$id");
			$profile = mysql_fetch_array($sqlprofile,MYSQL_ASSOC);		// Hasil data profile
				
			if ($filter == "user") {
				$sqlcount = mysql_query("SELECT COUNT(*) FROM user WHERE username LIKE '%$query%' OR email LIKE '%$query%' OR fullname LIKE '%$query%'");
				$count = mysql_fetch_row($sqlcount);		// numrows
				$sqlu = mysql_query("SELECT * FROM user WHERE username LIKE '%$query%' OR email LIKE '%$query%' OR fullname LIKE '%$query%' LIMIT $offset, $rowsperpage");
				$resultu = array();		// Result user yang bakal digabung ke result utama
				if(mysql_num_rows($sqlu) > 0){
					while ($rlt = mysql_fetch_array($sqlu,MYSQL_ASSOC)) {
						$resultu[] = $rlt;
					}
				}
			} else if ($filter == "category") {
				$sqlcount = mysql_query("SELECT COUNT(*) FROM kategori WHERE namakat LIKE '%$query%'");
				$count = mysql_fetch_row($sqlcount);		// numrows
				$sqlc = mysql_query("SELECT * FROM kategori WHERE namakat LIKE '%$query%' LIMIT $offset, $rowsperpage");
				$resultc = array();		// Result category yang bakal digabung ke result utama
				if(mysql_num_rows($sqlc) > 0){
					while ($rlt = mysql_fetch_array($sqlc,MYSQL_ASSOC)) {
						$resultc[] = $rlt;
					}
				}
			} else if ($filter == "task") {
				$sqlcount = mysql_query("SELECT COUNT(*) FROM tugas WHERE namatask LIKE '%$query%'");
				$count = mysql_fetch_row($sqlcount);		// numrows
				$sqlt = mysql_query("SELECT * FROM tugas WHERE namatask LIKE '%$query%' LIMIT $offset, $rowsperpage");
				$resultt = array();		// Result task yang bakal digabung ke result utama
				if(mysql_num_rows($sqlt) > 0){
					while ($rlt = mysql_fetch_array($sqlt,MYSQL_ASSOC)) {
						$namatask = $rlt['namatask'];
						$sqltag = mysql_query("SELECT * FROM tugas as tu, tag as t WHERE tu.id=t.idtask AND namatask LIKE '$namatask'");
						$tag = array();
						while ($rlttag = mysql_fetch_array($sqltag,MYSQL_ASSOC)) {
							$tag[] = $rlttag['namatag'];
						}
						$rlt['tag'] = $tag;
						$idkat = $rlt['idkat'];
						$sql_namakat = mysql_query("SELECT namakat FROM kategori WHERE id = ".$idkat);
						$namakat = mysql_fetch_row($sql_namakat);
						$rlt['namakat'] = $namakat[0];
						$resultt[] = $rlt;
					}
				}
			}
			
			$result = array();
			$result['profile'] = $profile;
			$result['rows'] = $count[0];
			if ($filter == "user") {
				$result['user'] = $resultu;
			} else if ($filter == "category") {
				$result['category'] = $resultc;
			} else if ($filter == "task") {
				$result['task'] = $resultt;
			}
			// If success everything is good send header as "OK" and user details
			$this->response($this->json($result), 200);
		}
		
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}
	
	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>