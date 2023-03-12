<form action="?page=Login-Validasi" method="post" name="form1" target="_self" id="form1">
  <table width="500" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#999999" class="table-list">
    <tr>
      <td width="106" rowspan="5" align="center" bgcolor="#CCCCCC"><img src="images/login-key.png" width="116" height="75" /></td>
      <th colspan="2" bgcolor="#CCCCCC"><b>LOGIN PETUGAS</b> </td>      </th>
    </tr>
    <tr>
      <td width="117" bgcolor="#FFFFFF"><strong>Username</strong></td>
      <td width="263" bgcolor="#FFFFFF"><b>:
        <input name="txtUser" type="text" size="30" maxlength="20" />
      </b></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><strong>Password</strong></td>
      <td bgcolor="#FFFFFF"><b>:
        <input name="txtPassword" type="password" size="30" maxlength="20" />
      </b></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><strong>Level Akses </strong></td>
      <td bgcolor="#FFFFFF"><b>:
        <select name="cmbLevel">
              <option value="KOSONG">....</option>
              <?php
		$pilihan = array("Klinik", "Apotek", "Admin");
		foreach ($pilihan as $nilai) {
			if ($_POST['cmbLevel']==$nilai) {
				$cek="selected";
			} else { $cek = ""; }
			echo "<option value='$nilai' $cek>$nilai</option>";
		}
		?>
        </select>
      </b></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="btnLogin" value=" Login " /></td>
    </tr>
  </table>
</form>