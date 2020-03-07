<?php

	require("connect.php");
	session_start();
	
	define("LIM_INTREB", 26);
	
	$connection = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
	if(!$connection) { die("A aparut o problema!"); }
	
	//Redirectioneaza catre o alta pagina
	function redirect($page_to_redirect) {
		header("Location: {$page_to_redirect}");
		exit;
	}
	
	///Extrage toate chestionarele din baza de date ################MARCARE PT STERGERE################MARCARE PT STERGERE
	/*function get_AllChest() {
		global $connection;
		$query = "SELECT * FROM chestionar";
		$result = mysql_query($query, $connection);
		return $result;
	}*/
	
	///Extrage un chestionar specificat de id################MARCARE PT STERGERE################MARCARE PT STERGERE
	/*function get_OneChest($id) {
		global $connection;
		$query = "SELECT * FROM chestionar WHERE id={$id} LIMIT 1";
		$result = mysql_query($query, $connection);
		$chest = mysql_fetch_array($result);
		return $result;
	}*/
	
	//Extrage o intrebare din baza de date specificata de id (cerinta, imagine, variante, raspuns corect)
	function get_OneIntreb($id) {
		global $connection;
		$stmt = $connection->prepare("SELECT * FROM intrebari WHERE id=:id LIMIT 1");
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	///################MARCARE PT STERGEREExtrage id-urile intrebarilor pe care le contine chestionarul specificat de id ################MARCARE PT STERGERE################MARCARE PT STERGERE
	/*function get_IntrebChest($id) {
		global $connection;
		$query = "SELECT intreb FROM chestionar WHERE id={$id} LIMIT 1";
		$result = mysql_query($query, $connection);
		$intreb = mysql_fetch_array($result);
		$id_intreb = explode("," , $intreb['intreb']); 
		$id_intreb = array_filter($id_intreb);
		return $id_intreb; //Array cu id-urile intrebarilor din chestionarul respectiv
	}*/
	
	///Afiseaza numarul de chestionare existente in data de baze################MARCARE PT STERGERE################MARCARE PT STERGERE
	/*function get_NrChest() {
		global $connection;
		$query = "SELECT id FROM chestionar ORDER BY id DESC LIMIT 1";
		$result = mysql_query($query, $connection);
		$nr_chesti = mysql_fetch_array($result);
		$nr_chest = $nr_chesti['id'];
		return $nr_chest;
	}*/
	
	//Afiseaza numarul de intrebari existente in data de baze
	function get_NrIntreb() {
		global $connection;
		$stmt = $connection->prepare("SELECT id FROM intrebari ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$nr_chesti = $stmt->fetch(PDO::FETCH_ASSOC);
		$nr_chest = $nr_chesti['id'];
		return $nr_chest;
	}
	
	
	function drawForm_intrebareModifica($id_intreb) {
	
		$o_intrebare = get_OneIntreb($id_intreb);
		
		$html_var = "
			<form action=\"upload.php\" method=\"POST\" enctype=\"multipart/form-data\">
				<table id=\"formular\">
					<tr><th>Cerinta:</th><td><textarea name=\"chest_cerinta\" style=\"width: 400px; height: 50px; vertical-align:top;\">{$o_intrebare['cerinta']}</textarea></td>
					<tr><th>Imagine:</th><td><input type=\"file\" name=\"chest_imagine\" value=\"{$o_intrebare['imagine']}/></td>	
					<tr><th>Variante:</th><tr><td><textarea name=\"chest_variante\" style=\"width: 500px; height: 70px; vertical-align:top;\">{$o_intrebare['variante']}</textarea></td>
					<tr><th>Raspunsurile:</th><td>
												<ul>
													<li><div style=\"background: url(images/A_up.jpg) no-repeat; background-size:75%; width: 48px; height: 40px; background-position: center center;\"><input type=\"checkbox\" name=\"chest_rasp_a\" value=\"da\"></div></li>
													<li><div style=\"background: url(images/B_up.jpg) no-repeat; background-size:75%; width: 48px; height: 40px; background-position: center center;\"><input type=\"checkbox\" name=\"chest_rasp_b\" value=\"da\"></div></li>
													<li><div style=\"background: url(images/C_up.jpg) no-repeat; background-size:75%; width: 48px; height: 40px; background-position: center center;\"><input type=\"checkbox\" name=\"chest_rasp_c\" value=\"da\"></div></li>
												</ul>
											</td>
				
					<tr><td colspan = \"2\" class=\"buton\"><input type=\"submit\" name=\"adauga_intreb\" value=\"Modifica intrebare\" class=\"submit\"/>
				</table>
			</form>
			";
		echo $html_var;
	}
	
	///################MARCARE PT STERGERE################MARCARE PT STERGERE
	/*function drawForm_chestionarAlege() {
		
		$html_var = "<table id=\"tabel_chest\">
				<tr><th>Chestionar</th><th>Nr. Intrebari</th><th>Actiune</th></tr>";
		$result = get_allChest();
		while($un_chestionar = mysql_fetch_array($result)) {
			$html_var .= "
						<tr>
						<td>Chestionar {$un_chestionar['id']}</td>
						<td>{$un_chestionar['nr_intreb']}</td>
						<td>
							<form action=\"modifica.php\" method=\"POST\" name=\"chestAlege{$un_chestionar['id']}\">
								<input type=\"hidden\" name=\"mod_chest\" value=\"{$un_chestionar['id']}\"/>
								<a href=\"javascript:document.chestAlege{$un_chestionar['id']}.submit()\" id=\"link\">Modifica</a>
							</form>
						</tr>";
		}
		$html_var .= "</table>";
		
		
		echo $html_var;
	}*/
	

	
	///Afiseaza o intrebare care se afla in chestionarul specificat de $id_chest. ################MARCARE PT STERGERE################MARCARE PT STERGERE
	/*function afiseaza_intrebari_chest($nr_intr, $id_intreb,$id_chest) {
		global $connection;
		$query="SELECT * FROM intrebari WHERE id={$id_intreb} LIMIT 1";
		$result = mysql_query($query, $connection); 
		
		$o_intrebare = mysql_fetch_array($result);
		echo "<div class = \"result\">";
		echo "<span id = \"s\">";
		echo "<a href=\"icreate.php?id={$o_intrebare['id']}\">Intrebarea {$nr_intr} - Cod {$o_intrebare['id']}</a>";
		echo "<p>{$o_intrebare['cerinta']}</p>";
		echo "</span><span id=\"d\">";
		if(!empty($o_intrebare['imagine'])) {
			echo "<img src=\"{$o_intrebare['imagine']}\"/>";
		}
		echo "</span>";

		echo "<span id=\"j\" style=\"text-align:center;\">
				<ul>
					<li><a href=\"imodifica.php?id={$id_intreb}\">Modifica intrebarea</a></li>
					<li><a href=\"adauga.php?del_intreb_id={$o_intrebare['id']}&del_chest_id={$id_chest}\">Sterge-o din chestionar</a></li>

				</ul>
			</span>";
			
		echo "</div>";
	}*/
	
	///################MARCARE PT STERGERE################MARCARE PT STERGERE
	/*function afiseaza_intrebari($id_intreb,$id_chest=0) {
		global $connection;
		if($id_chest != 0) {
			for($i=1;$i<=get_NrChest();$i++) {
				$id_intrebari_chest = get_IntrebChest($i);
				for($j=0; $j<count($id_intrebari_chest); $j++) {
					if($id_intrebari_chest[$j] == $id_intreb) {
						$exista_in_chest[] = $i; //Intrebarea $id_intreb exista si in chestionarul $i
					}
				}
			}
		}
		$query="SELECT * FROM intrebari WHERE id={$id_intreb} LIMIT 1";
		$result = mysql_query($query, $connection); 
		
		$o_intrebare = mysql_fetch_array($result);
		echo "<div class = \"result\">";
		echo "<span id = \"s\">";
		echo "<p>{$o_intrebare['cerinta']}</p>";
		echo "</span><span id=\"d\">";
		if(!empty($o_intrebare['imagine'])) {
			echo "<img src=\"{$o_intrebare['imagine']}\"/>";
		}
		echo "</span>";
		
		echo "<span id=\"j\" style=\"text-align:center;\">
				<ul>
					<li><form method=\"POST\" action=\"ieticheta.php\"><input type=\"text\" name=\"etic\"/><input type=\"submit\" name=\"submit\" value=\"submit\"/></form></li>
				</ul>
			</span>";

		echo "</div>";
	}
*/
	
	function moveElement(&$array, $a, $b) {
		$out = array_splice($array, $a, 1);
		array_splice($array, $b, 0, $out);
	}
	